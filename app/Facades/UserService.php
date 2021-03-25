<?php

/**
 *
 * ----------------------------------- PHP -----------------------------------
 *                              PHP是世界上最好的语言
 * ===========================================================================
 * @created          PhpStorm
 * ===========================================================================
 * @file             UserService.php
 * ===========================================================================
 * @author           zhoushuaishuai <zhouqu@vmcshop.com>
 * ===========================================================================
 * @ctime:           2021/3/24 上午11:26
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
 * Class UserService
 * @package App\Facades
 * @method static queryByUsername(string $username)
 * @method static bool checkUserSendCaptchaCode(string $mobile)
 * @method static string setUserCaptchaCode(string $mobile)
 * @method static bool checkUserCaptchaCode(string $mobile, string $code)
 * @method static string generateCaptchaCodeKey(string $string)
 * @method static sendCaptchaCode(string $string,string $code)
 */
class UserService extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'userService';
    }
}
