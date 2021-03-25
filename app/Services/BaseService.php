<?php

/**
 *
 * ----------------------------------- PHP -----------------------------------
 *                              PHP是世界上最好的语言
 * ===========================================================================
 * @created          PhpStorm
 * ===========================================================================
 * @file             BaseService.php
 * ===========================================================================
 * @author           zhoushuaishuai <zhouqu@vmcshop.com>
 * ===========================================================================
 * @ctime:           2021/3/24 下午9:49
 * ===========================================================================
 * @version          1.0
 * ===========================================================================
 *
 * ----------------------------------- PHP -----------------------------------
 *
 */

namespace App\Services;

class BaseService
{
    protected static $_instance;

    private function __construct()
    {

    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (static::$_instance instanceof static) {
            return static::$_instance;
        }
        static::$_instance = new static;
        return static::$_instance;
    }
}
