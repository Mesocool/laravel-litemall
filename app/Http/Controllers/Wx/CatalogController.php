<?php

namespace App\Http\Controllers\Wx;

use App\CodeResponse;
use App\Facades\CatalogService;
use Illuminate\Http\Request;

class CatalogController extends WxController
{
    //
    protected $only = [];

    /**
     * 分类列表
     * Date: 2021/3/26
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $l1CatList = CatalogService::queryL1();
        $id = $request->input('id', 0);
        $cId = $id ?: $l1CatList->first()->id;
        $currentCategory = CatalogService::getCatagoryById($cId);
        $currentCategory ? $currentSubCategory = CatalogService::queryByPid($currentCategory->id) : $currentSubCategory = null;
        return $this->success([
            'categoryList' => $l1CatList,
            'currentCategory' => $currentCategory,
            'currentSubCategory' => $currentSubCategory,
        ]);
    }

    /**
     * 当前分类
     * Date: 2021/3/26
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function current(Request $request)
    {
        $cid = $request->input('id', 0);
        if (!$cid || $cid < 1) {
            return $this->failure(CodeResponse::PARAM_BAD_VALUE);
        }
        $currentCategory = CatalogService::getCatagoryById($cid);
        if (!$currentCategory) {
            return $this->failure(CodeResponse::PARAM_BAD_VALUE);
        }
        $currentSubCategory = CatalogService::queryByPid($currentCategory->id) ?: null;
        return $this->success([
            'currentCategory' => $currentCategory,
            'currentSubCategory' => $currentSubCategory,
        ]);
    }
}
