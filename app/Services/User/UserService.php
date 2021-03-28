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
 * @ctime:           2021/3/24 上午11:19
 * ===========================================================================
 * @version          1.0
 * ===========================================================================
 *
 * ----------------------------------- PHP -----------------------------------
 *
 */

namespace App\Services\User;

use App\CodeResponse;
use App\Exceptions\BusinessException;
use App\Models\User\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserService
{

    /**
     * Date: 2021/3/24
     * 根据用户名查询用户名是否存在
     * @param $username
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function queryByUsername($username)
    {
        return User::query()->where('username', $username)->first();
    }

    /**
     * Date: 2021/3/24
     * @param $mobile
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function queryByMobile($mobile)
    {
        return User::query()->where('mobile', $mobile)->first();
    }

    public function saveUser($userInput = [])
    {
        return User::create([
            'username' => $userInput['username'],
            'password' => Hash::make($userInput['password']),
            'gender' => 0,
            'nickname' => $userInput['username'],
            'mobile' => $userInput['mobile'],
            'avatar' => 'https://yanxuan.nosdn.127.net/80841d741d7fa3073e0ae27bf487339f.jpg',
            'status' => 0,
            'user_level' => 0,
            'last_login_ip' => request()->getClientIp(),
            'last_login_time' => Carbon::now()->toDateTimeString(),
        ]);
    }

    public function checkUserSendCaptchaCode($mobile)
    {
        $countLimitKey = __FUNCTION__ . 'Count:' . $mobile;
        if (Cache::has($countLimitKey)) {
            $count = Cache::increment($countLimitKey);
            if ($count > 10) {
                return false;
            }
        } else {
            Cache::put($countLimitKey, 1, Carbon::tomorrow()->diffInSeconds(Carbon::now()));
        }
        return true;
    }

    public function generateCaptchaCodeKey(string $string)
    {
        return 'CaptchaCodeKey:' . $string;;
    }

    public function setUserCaptchaCode($mobile)
    {
        // 保存手机 验证码
        $mobileRegisterCodeKey = self::generateCaptchaCodeKey($mobile);
        $code = random_int(100000, 999999);
        $code = strval($code);
        Cache::put($mobileRegisterCodeKey, $code, 600);
        return $code;
    }

    public function sendCaptchaCode($mobile, $code)
    {
//        return Notification::route(
//            EasySmsChannel::class,
//            new PhoneNumber($mobile, 86)
//        )->notify(new VerificationCode($code));
    }

    public function checkUserCaptchaCode($mobile, $code)
    {
        $codeValue = Cache::get(self::generateCaptchaCodeKey($mobile), '');
//        return $codeValue === $code;
//        if ($codeValue !== $code) return false;
//        $this->delUserCaptchaCode($mobile);
//        return true;
        if($codeValue !== $code){
            throw new BusinessException(CodeResponse::AUTH_CAPTCHA_UNMATCH);
        }
        $this->delUserCaptchaCode($mobile);
        return true;
    }

    public function delUserCaptchaCode($mobile)
    {
        return Cache::forget(self::generateCaptchaCodeKey($mobile));
    }

    public $value;
    public function testValue()
    {
        $this->value = 2;
    }
    public function getValue(){
        return $this->value;
    }
}
