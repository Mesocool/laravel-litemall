<?php

/**
 *
 * ----------------------------------- PHP -----------------------------------
 *                              PHP是世界上最好的语言
 * ===========================================================================
 * @created          PhpStorm
 * ===========================================================================
 * @file             GoodsService.php
 * ===========================================================================
 * @author           zhoushuaishuai <zhouqu@vmcshop.com>
 * ===========================================================================
 * @ctime:           2021/3/28 下午6:02
 * ===========================================================================
 * @version          1.0
 * ===========================================================================
 *
 * ----------------------------------- PHP -----------------------------------
 *
 */

namespace App\Services\Goods;

use App\FromCode;
use App\Models\Collect;
use App\Models\Comment;
use App\Models\Goods\Goods;
use App\Models\Goods\GoodsAttribute;
use App\Models\Goods\GoodsProduct;
use App\Models\Goods\GoodsSpecification;
use App\Models\Issue;
use App\Models\User\User;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class GoodsService extends BaseService
{


    public function queryOnSale()
    {
        return Goods::query()->where('is_on_sale', 1)->where('deleted', 0)->get();
    }

    public function querySelective(
        $categoryId = null,
        $brandId = null,
        $keyword = '',
        $isHot = null,
        $isNew = null,
        $page = 1,
        $limit = 10,
        $sort = '',
        $order = ''
    )
    {
        $query = $this->getGoodsQueryByBrandAndKeywordAndHostAndNew($brandId, $keyword, $isHot, $isNew);
        !is_null($categoryId) && $query = $query->where('category_id', $categoryId);
        return $query->orderBy($sort, $order)->paginate($limit, ['*'], 'page', $page);
    }

    public function getCatIds(
        $brandId = null,
        $keyword = '',
        $isHot = null,
        $isNew = null)
    {
        $query = $this->getGoodsQueryByBrandAndKeywordAndHostAndNew($brandId, $keyword, $isHot, $isNew);
        return $query->select('category_id')->pluck('category_id')->unique()->toArray();
    }

    private function getBasicGoodsQuery()
    {
        return Goods::query()->where('deleted', 0);
    }

    private function getGoodsQueryByBrandAndKeywordAndHostAndNew(
        $brandId = null,
        $keyword = '',
        $isHot = null,
        $isNew = null)
    {
        $query = $this->getBasicGoodsQuery()->where('is_on_sale', 1);
        !is_null($brandId) && $query = $query->where('brand_id', (int)$brandId);
        !is_null($keyword) && $query = $query->where(function (Builder $query) use ($keyword) {
            $query = $query->where('keyword', 'like', "%$keyword%")->orWhere('name', 'like', "%$keyword%");
        });
        !is_null($isHot) && $query = $query->where('is_hot', (int)$isHot);
        !is_null($isNew) && $query = $query->where('is_new', (int)$isNew);
        return $query;
    }

    public function findById(int $id)
    {
        return $this->getBasicGoodsQuery()->where('id', $id)->first();
    }

    public function queryAttributeByGid($id)
    {
        return GoodsAttribute::query()->where('goods_id', $id)->where('deleted', 0)->get();
    }

    public function querySpecificationByGid($id)
    {
        return GoodsSpecification::query()->where('goods_id', $id)->where('deleted', 0)->get();
    }

    public function getSpecificationVoList($id)
    {
        return $this->querySpecificationByGid($id)->groupBy('specification')->map(function ($item, $key) {
            return ['name' => $key, 'valueList' => $item];
        })->values();
    }

    public function queryProductByGid($id)
    {
        return GoodsProduct::query()->where('goods_id', $id)->where('deleted', 0)->get();
    }

    public function queryIssueSelective($page = 1, $limit = 4)
    {
        return Issue::query()->forPage($page, $limit)->get();
    }

    public function queryGoodsCommentByGid($id, $page = 1, $limit = 10)
    {
        $comment = Comment::query()->where('value_id', $id)->where('type', FromCode::COMMENT_TYPE_GOODS_CODE)
            ->where('deleted', 0)->paginate($limit, ['*'], 'page', $page);
        return $comment;

    }

    public function queryGoodsCollectById($uid, $gid)
    {
        return Collect::query()->where('user_id', $uid)->where('value_id', $gid)->where('type', FromCode::COLLECT_TYPE_GOODS_CODE)->count();
    }

    public function queryGoodsCommentWithUserInfoByGid($id, $page = 1, $limit = 10)
    {
        $comment = $this->queryGoodsCommentByGid($id, $page, $limit);
        if ($comment['data']) {
            $uids = array_unique(Arr::pluck($comment, 'user_id'));
            $users = User::query()->whereIn('id', $uids)->where('deleted', 0)->get()->keyBy('id');
            collect($comment->items())->map(function ($item) use ($users) {
                $user = $users->get($item->user_id);
                $item = $item->toArray();
                $item['picList'] = $item['picUrls'];
                $item = Arr::only($item, ['id', 'addTime', 'content', 'adminContent', 'picList']);
                $item['nickname'] = $user->nickname ?? '';
                $item['avatar'] = $user->avatar ?? '';
                return $item;
            });
        }
        return ['data' => $comment->items(), 'count' => $comment->count()];
    }
}