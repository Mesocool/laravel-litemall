<?php

/**
 *
 * ----------------------------------- PHP -----------------------------------
 *                              PHP是世界上最好的语言
 * ===========================================================================
 * @created          PhpStorm
 * ===========================================================================
 * @file             MyService.php
 * ===========================================================================
 * @author           zhoushuaishuai <zhouqu@vmcshop.com>
 * ===========================================================================
 * @ctime:           2021/3/26 下午4:41
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
 * Class BrandService
 * @package App\Facades
 * @method static Model|null query(int $page, int $limit, string $sort = '', string $order = '', array $columns = ['*'])
 * @method static Model|null findById(int $id)
 */
class BrandService extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'brandService';
    }
}
