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

use App\Models\Goods\Goods;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;

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
        return $query->select('category_id')->pluck('category_id')->toArray();
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
        return $this->getBasicGoodsQuery()->where('id',$id)->first();
    }
}