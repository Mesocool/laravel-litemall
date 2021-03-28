<?php

namespace App\Http\Controllers\Wx;

use App\CodeResponse;
use App\Facades\AddressService;
use Illuminate\Http\Request;

class AddressController extends WxController
{
    protected $except = [];

    /**
     * 地址列表
     * Date: 2021/3/26
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        $list = AddressService::queryByUid($this->user()->id);
        return $this->successPaginate($list);
    }

    /**
     * 保存地址
     * Date: 2021/3/26
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $address = AddressService::saveAddress($this->user()->id, $request->all());
        return $this->success($address->id);
    }

    /**
     * 地址删除
     * Date: 2021/3/26
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        AddressService::deleteAddress($this->user()->id, $request->input('id'));
        return $this->success();
    }

    /**
     * 地址详情
     * Date: 2021/3/26
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(Request $request)
    {
        $address = AddressService::queryByUidAndAdressId($this->user()->id, $request->input('id'));
        if (!$address) {
            return $this->failure(CodeResponse::PARAM_BAD_VALUE);
        }
        return $this->success($address->toArray());
    }

}
