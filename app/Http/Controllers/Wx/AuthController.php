<?php

namespace App\Http\Controllers\Wx;

use App\CodeResponse;
use App\Facades\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends WxController
{
    /**
     * @var array
     */
    protected $only = ['info', 'logout', 'profile'];

    /**
     * 修改用户信息
     * Date: 2021/3/25
     * @param Request $request
     * @return JsonResponse
     */
    public function profile(Request $request)
    {
        $avatar = $request->input('avatar');
        $gender = $request->input('gender');
        $nickname = $request->input('nickname');
        $userInfo = $this->user();
        if ($avatar) {
            $userInfo->avatar = $avatar;
        }
        if ($gender) {
            $userInfo->gender = $gender;
        }
        if ($nickname) {
            $userInfo->nickname = $nickname;
        }
        return $this->successOrFail($userInfo->save(), CodeResponse::UPDATE_FAILED);
    }


    /**
     * 用户信息
     * Date: 2021/3/25
     * @return JsonResponse
     */
    public function info()
    {
        $user = $this->user();

        return $this->success([
            'nickName' => $user->nickname,
            'avatar' => $user->avatar,
            'mobile' => $user->mobile,
            'gender' => $user->gender,
        ]);
    }

    /**
     * 用户登出
     * Date: 2021/3/25
     * @return JsonResponse|void
     */
    public function logout()
    {
        Auth::guard('wx')->logout();
        return $this->success();
    }

    /**
     * 用户登录
     * Date: 2021/3/25
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        if (!$username || !$password) {
            return $this->failure(CodeResponse::PARAM_ILLEGAL);
        }
        $user = UserService::queryByUsername($username);
        if (!$user) {
            return $this->failure(CodeResponse::AUTH_INVALID_ACCOUNT, '账号不存在');
        }
        if (!Hash::check($password, $user->password)) {
            return $this->failure(CodeResponse::AUTH_INVALID_ACCOUNT, '账户密码错误');
        }
        $user->last_login_time = now()->toDateTimeString();
        $user->last_login_ip = $request->getClientIp();
        $user->save();
        $token = Auth::guard('wx')->login($user);
        return $this->success([
                'token' => $token,
                'userInfo' => $user]
        );
    }

    /**
     * 注册验证码
     * Date: 2021/3/25
     * @param Request $request
     * @return JsonResponse
     */
    public function registerCaptcha(Request $request)
    {
        $mobile = $request->input('mobile');
        if (!$mobile) {
            return $this->failure(CodeResponse::PARAM_ILLEGAL);
        }
        $validate = Validator::make(['mobile' => $mobile], ['mobile' => 'regex:/^1[0-9]{10}$/']);
        if ($validate->fails()) {
            return $this->failure(CodeResponse::AUTH_INVALID_MOBILE);
        }
        //60秒内不能重复发送
        $timeLimitKey = __FUNCTION__ . 'Limit:' . $mobile;
        if (!Cache::add($timeLimitKey, 1, 60)) {
            return $this->failure(CodeResponse::AUTH_CAPTCHA_FREQUENCY, '1分钟内不能重复发送验证码');
        }
        //检测今日是否还能发送验证码
        if (!UserService::checkUserSendCaptchaCode($mobile)) {
            return $this->failure(CodeResponse::AUTH_CAPTCHA_FREQUENCY, '今日发送验证码已达上线');
        }
        //生成验证码
        $code = UserService::setUserCaptchaCode($mobile);
        //发送验证码...
        return $this->success([], '发送成功');
    }

    /**
     * 用户注册接口
     * Date: 2021/3/25
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $mobile = $request->input('mobile');
        $code = $request->input('code');
        if (!$username || !$password || !$mobile || !$code) {
            return $this->failure(CodeResponse::PARAM_ILLEGAL);
        }
        UserService::checkUserCaptchaCode($mobile, $code);
//        if (!UserService::checkUserCaptchaCode($mobile, $code)) {
//            return $this->failure(CodeResponse::AUTH_CAPTCHA_UNMATCH, '验证码错误');
//        }
        $username = UserService::queryByUsername($username);
        if ($username) {
            return $this->failure(CodeResponse::AUTH_NAME_REGISTERED, '用户名已注册');
        }
        $validate = Validator::make(['mobile' => $mobile], ['mobile' => 'regex:/^1[0-9]{10}$/']);
        if ($validate->fails()) {
            return $this->failure(CodeResponse::AUTH_INVALID_MOBILE);
        }
        $mobile = UserService::queryByMobile($mobile);
        if ($mobile) {
            return $this->failure(CodeResponse::AUTH_MOBILE_REGISTERED);
        }
        $user = UserService::saveUser($request->all());

        $token = Auth::guard('wx')->login($user);

        return $this->success([
                'token' => $token,
                'userInfo' => $user]
        );
    }

    /**
     * 重置密码
     * Date: 2021/3/25
     * @param Request $request
     * @return JsonResponse
     */
    public function reset(Request $request)
    {
        $password = $request->input('password');
        $mobile = $request->input('mobile');
        $code = $request->input('code');
        if (!$code || !$mobile || !$password) {
            return $this->failure(CodeResponse::PARAM_ILLEGAL);
        }
        //暂时不验证验证码 验证码正确
        $user = UserService::queryByMobile($mobile);
        if (!$user) {
            return $this->failure(CodeResponse::AUTH_MOBILE_UNREGISTERED);
        }
        $user->password = Hash::make($password);
        $ret = $user->save();
        return $this->successOrFail($ret, CodeResponse::UPDATE_FAILED);
    }

}
