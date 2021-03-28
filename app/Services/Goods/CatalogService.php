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
 * @ctime:           2021/3/26 下午2:21
 * ===========================================================================
 * @version          1.0
 * ===========================================================================
 *
 * ----------------------------------- PHP -----------------------------------
 *
 */

namespace App\Services\Goods;


use App\Models\Goods\Catalog;
use App\Services\BaseService;

class CatalogService extends BaseService
{

    public function queryL1()
    {
        return Catalog::query()->where('level','L1')->where('deleted',0)->get();
    }

    public function getCatagoryById(int $id)
    {
        return Catalog::query()->find($id);
    }

    public function queryByPid(int $pid)
    {
        return Catalog::query()->where('pid',$pid)->where('deleted',0)->get();
    }

    public function findById($id)
    {
        return Catalog::query()->where('id',$id)->where('deleted',0)->first();
    }

    public function queryL2ByIds(array $ids)
    {
        return Catalog::query()->whereIn('id',$ids)->get();
    }
}