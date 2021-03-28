<?php

namespace App\Http\Controllers\Wx;

use App\CodeResponse;
use App\Facades\CatalogService;
use App\Facades\GoodsService;
use App\Facades\SearchService;
use App\FromCode;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GoodsController extends WxController
{
    //
    protected $only = [];

    public function category(Request $request)
    {
        $cid = $request->input('id');
        $cur = CatalogService::findById($cid);
        if (!$cur) {
            return $this->failure(CodeResponse::PARAM_BAD_VALUE);
        }
        $parent = null;
        $children = null;
        if ($cur->pid == 0) {
            $parent = $cur;
            $children = CatalogService::queryByPid($cur->id);
            $cur = $children->first() ?? $cur;
        } else {
            $parent = CatalogService::findById($cur->pid);
            $children = CatalogService::queryByPid($cur->pid);
        }
        return $this->success([
            'currentCategory' => $cur,
            'parentCategory' => $parent,
            'brotherCategory' => $children,
        ]);
    }

    public function list(Request $request)
    {
        $categoryId = $request->input('categoryId');
        $brandId = $request->input('brandId');
        $keyword = $request->input('keyword');
        $isNew = $request->input('isNew');
        $isHot = $request->input('isHot');
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $sort = $request->input('sort', 'add_time');
        $order = $request->input('order', 'desc');
        if ($this->isLogin() && !$keyword) {
            SearchService::saveGoodsSearchHistory($this->user()->id, $keyword, FromCode::SEARCH_GOODS_HISTORY_FROM_WX);
        }
        $goods = GoodsService::querySelective($categoryId, $brandId, $keyword, $isHot, $isNew, $page, $limit, $sort, $order);
        $goodsCatIds = GoodsService::getCatIds($brandId, $keyword, $isHot, $isNew);
        $categoryList = null;
        if ($goodsCatIds) {
            $categoryList = CatalogService::queryL2ByIds($goodsCatIds);
        } else {
            $categoryList = collect([]);
        }
        $goods = $this->paginate($goods);
        $goods['filterCategoryList'] = $categoryList;
        return $this->success($goods);
    }

    public function count()
    {
        $goods = GoodsService::queryOnSale();
        return $this->success($goods);
    }

    public function detail(Request $request)
    {
        $id = $request->input('id');
        $info = GoodsService::findById($id);
        //TODO::


        return $this->success([
            'info' => $info
        ]);
    }
}
