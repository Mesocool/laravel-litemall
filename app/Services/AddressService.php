<?php

/**
 *
 * ----------------------------------- PHP -----------------------------------
 *                              PHP是世界上最好的语言
 * ===========================================================================
 * @created          PhpStorm
 * ===========================================================================
 * @file             AddressService.php
 * ===========================================================================
 * @author           zhoushuaishuai <zhouqu@vmcshop.com>
 * ===========================================================================
 * @ctime:           2021/3/25 下午9:51
 * ===========================================================================
 * @version          1.0
 * ===========================================================================
 *
 * ----------------------------------- PHP -----------------------------------
 *
 */

namespace App\Services;


use App\CodeResponse;
use App\Models\Address;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class AddressService extends BaseService
{

    public function queryByUid(int $id)
    {
        return Address::query()->where('id', $id)->where('deleted', 0)->get();
    }

    public function queryByUidAndAdressId(int $uid, int $addressId)
    {
        return Address::query()->where('id', $addressId)->where('user_id', $uid)->where('deleted', 0)->first();
    }

    public function dealList(Collection $list)
    {
        $list = $list->map(function ($item) {
            $newItem = [];
            foreach ($item->toArray() as $key => $val) {

                $newItem[lcfirst(Str::studly($key))] = $val;
            }
            return $newItem;
        });
        return $list;
    }

    public function saveAddress(int $uid, array $address)
    {
        if (!$uid || $uid < 1) {
            $this->throwBussinessException(CodeResponse::PARAM_ILLEGAL);
        }
        return Address::create([
            'name' => $address['name'],
            'user_id' => $uid,
            'province' => $address['province'],
            'city' => $address['city'],
            'county' => $address['county'],
            'address_detail' => $address['addressDetail'],
            'area_code' => $address['areaCode'],
            'postal_code' => $address['postalCode'],
            'tel' => $address['tel'],
            'is_default' => $address['isDefault'] ? 1 : 0,
        ]);
    }

    public function deleteAddress(int $uid, int $addressId)
    {
        $address = $this->queryByUidAndAdressId($uid,$addressId);
        if (!$address) {
            $this->throwBussinessException(CodeResponse::PARAM_BAD_VALUE);
        }
        return $address->delete();
    }
}