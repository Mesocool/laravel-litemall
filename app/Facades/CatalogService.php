<?php

/**
 *
 * ----------------------------------- PHP -----------------------------------
 *                              PHP是世界上最好的语言
 * ===========================================================================
 * @created          PhpStorm
 * ===========================================================================
 * @file             CatalogService.php
 * ===========================================================================
 * @author           zhoushuaishuai <zhouqu@vmcshop.com>
 * ===========================================================================
 * @ctime:           2021/3/26 下午2:23
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
 * Class CatalogService
 * @package App\Facades
 * @method static Model|null queryL1()
 * @method static Model|null getCatagoryById(int $id)
 * @method static Model|null queryByPid(int $pid)
 * @method static Model|null findById(int $id)
 *
 */
class CatalogService extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'catalogService';
    }
}