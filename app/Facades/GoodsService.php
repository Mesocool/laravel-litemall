<?php

/**
 *
 * ----------------------------------- PHP -----------------------------------
 *                              PHP是世界上最好的语言
 * ===========================================================================
 * @created          PhpStorm
 * ===========================================================================
 * @file             GoodsService.php
 * ===========================================================================
 * @author           zhoushuaishuai <zhouqu@vmcshop.com>
 * ===========================================================================
 * @ctime:           2021/3/28 下午6:03
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
 * Class GoodsService
 * @package App\Facades
 * @method static Model|null queryOnSale()
 * @method static Model|null querySelective($categoryId = null, $brandId = null, $keyword = '', $isHot = null, $isNew = null, $page = 1, $limit = 10, $sort = '', $order = '')
 * @method static Model|null getCatIds($brandId = null, $keyword = '', $isHot = null, $isNew = null)
 * @method static Model|null findById($id)
 * @method static Model|null queryAttributeByGid($id)
 * @method static Model|null querySpecificationByGid($id)
 * @method static Model|null getSpecificationVoList($id)
 * @method static Model|null queryProductByGid($id)
 * @method static Model|null queryIssueSelective($page = 1, $limit = 4)
 * @method static Model|null queryGoodsCommentByGid($id, $page = 1, $limit = 10)
 * @method static Model|null queryGoodsCollectById($uid, $gid)
 * @method static Model|null queryGoodsCommentWithUserInfoByGid($id, $page = 1, $limit = 10)
 */
class GoodsService extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'goodsService';
    }
}