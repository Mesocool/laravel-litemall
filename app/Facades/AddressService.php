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
 * @ctime:           2021/3/25 下午9:53
 * ===========================================================================
 * @version          1.0
 * ===========================================================================
 *
 * ----------------------------------- PHP -----------------------------------
 *
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;


/**
 * Class AddressService
 * @package App\Facades
 * @method static Model|null queryByUid(int $id)
 * @method static Model|null dealList(Collection $list)
 * @method static Model|false|BusinessException saveAddress(int $uid,array $address)
 * @method static true|false|BusinessException deleteAddress(int $uid,array $addressId)
 * @method static Model|null queryByUidAndAdressId(int $uid,array $addressId)
 */
class AddressService extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'addressService';
    }
}
