<?php

namespace App\Http\Controllers\Wx;

use App\CodeResponse;
use App\Facades\AddressService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressController extends WxController
{
    protected $except = [];

    public function list()
    {
        $list = AddressService::queryByUid($this->user()->id);
        $list = AddressService::dealList($list);
        return $this->success([
            'total' => $list->count(),
            'page' => 1,
            'limit' => $list->count(),
            'pages' => 1,
            'list' => $list ? $list->toArray() : [],
        ]);
    }

    public function save(Request $request)
    {
        $address = AddressService::saveAddress($this->user()->id, $request->all());
        return $this->success($address->id);
    }

    public function delete(Request $request)
    {
        AddressService::deleteAddress($this->user()->id, $request->input('id'));
        return $this->success();
    }

    public function detail(Request $request)
    {
        $address = AddressService::queryByUidAndAdressId($this->user()->id, $request->input('id'));
        if (!$address) {
            return $this->failure(CodeResponse::PARAM_BAD_VALUE);
        }
        return $this->success($address->toArray());
    }

}
