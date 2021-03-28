<?php

/**
 *
 * ----------------------------------- PHP -----------------------------------
 *                              PHP是世界上最好的语言
 * ===========================================================================
 * @created          PhpStorm
 * ===========================================================================
 * @file             BrandService.php
 * ===========================================================================
 * @author           zhoushuaishuai <zhouqu@vmcshop.com>
 * ===========================================================================
 * @ctime:           2021/3/26 下午4:38
 * ===========================================================================
 * @version          1.0
 * ===========================================================================
 *
 * ----------------------------------- PHP -----------------------------------
 *
 */

namespace App\Services\Goods;


use App\Models\Goods\Brand;
use App\Services\BaseService;

class BrandService extends BaseService
{

    public function query(int $page, int $limit, string $sort = '', string $order = '', array $columns = ['*'])
    {
        $query = Brand::query()->where('deleted', 0);
        ($sort && $order) && $query->orderBy($sort, $order);
        return $query->paginate($limit, $columns, 'page', $page);
    }

    public function findById($id)
    {
        return Brand::query()->find($id);
    }
}