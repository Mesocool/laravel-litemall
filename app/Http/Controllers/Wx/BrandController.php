<?php

namespace App\Http\Controllers\Wx;

use App\CodeResponse;
use App\Facades\BrandService;
use Illuminate\Http\Request;

class BrandController extends WxController
{
    protected $only = [];

    /**
     * 品牌列表
     * Date: 2021/3/26
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $sort = $request->input('sort', 'add_time');
        $order = $request->input('order', 'desc');
        $brand = BrandService::query($page, $limit, $sort, $order);
        return $this->successPaginate($brand);
    }

    /**
     * 品牌详情
     * Date: 2021/3/26
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(Request $request)
    {
        $id = $request->input('id', 0);
        if (!$id || $id < 1) {
            return $this->failure(CodeResponse::PARAM_BAD_VALUE);
        }
        $brand = BrandService::findById($id);
        return $this->success($brand);
    }
}
