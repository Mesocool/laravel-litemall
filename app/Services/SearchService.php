<?php

/**
 *
 * ----------------------------------- PHP -----------------------------------
 *                              PHP是世界上最好的语言
 * ===========================================================================
 * @created          PhpStorm
 * ===========================================================================
 * @file             SearchService.php
 * ===========================================================================
 * @author           zhoushuaishuai <zhouqu@vmcshop.com>
 * ===========================================================================
 * @ctime:           2021/3/28 下午6:52
 * ===========================================================================
 * @version          1.0
 * ===========================================================================
 *
 * ----------------------------------- PHP -----------------------------------
 *
 */

namespace App\Services;


use App\Models\SearchHistory;

class SearchService extends BaseService
{

    public function saveGoodsSearchHistory(int $uid, string $keyword, string $from)
    {
        return SearchHistory::query()->create([
            'user_id' => $uid,
            'keyword' => $keyword,
            'from' => $from,
        ]);
    }
}