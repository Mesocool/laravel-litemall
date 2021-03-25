<?php

/**
 *
 * ----------------------------------- PHP -----------------------------------
 *                              PHP是世界上最好的语言
 * ===========================================================================
 * @created          PhpStorm
 * ===========================================================================
 * @file             CodeResponse.php
 * ===========================================================================
 * @author           zhoushuaishuai <zhouqu@vmcshop.com>
 * ===========================================================================
 * @ctime:           2021/3/24 下午9:28
 * ===========================================================================
 * @version          1.0
 * ===========================================================================
 *
 * ----------------------------------- PHP -----------------------------------
 *
 */

namespace App;

class CodeResponse
{
    // 标准返回
    const SUCCESS = [0, '操作成功'];
    const FAILURE = [-1, '操作失败'];
    const PARAM_ILLEGAL = [401, '非法参数'];
    const UN_LOGIN = [501,'未登录'];
    const UPDATE_FAILED = [505,'更新数据失败'];

    // 业务状态码
    const AUTH_INVALID_ACCOUNT = [700, '账户非法'];
    const AUTH_CAPTCHA_UNSUPPORT = [701, '验证码服务不支持'];
    const AUTH_CAPTCHA_FREQUENCY = [702, '验证码重复发送'];
    const AUTH_CAPTCHA_UNMATCH = [703, '验证码错误'];
    const AUTH_NAME_REGISTERED = [704, '用户名已注册'];
    const AUTH_MOBILE_REGISTERED = [705, '手机号已注册'];
    const AUTH_MOBILE_UNREGISTERED = [706, '手机号未注册'];
    const AUTH_INVALID_MOBILE = [707, '手机号格式错误'];
    const AUTH_OPENID_UNACCESS = [708, 'OPENID 获取失败'];
    const AUTH_OPENID_BINDED = [709, 'OPENID已绑定账号'];

    const GOODS_UNSHELVE = 710;
    const GOODS_NO_STOCK = 711;
    const GOODS_UNKNOWN = 712;
    const GOODS_INVALID = 713;

    const ORDER_UNKNOWN = 720;
    const ORDER_INVALID = 721;
    const ORDER_CHECKOUT_FAIL = 722;
    const ORDER_CANCEL_FAIL = 723;
    const ORDER_PAY_FAIL = 724;
    // 订单当前状态下不支持用户的操作，例如商品未发货状态用户执行确认收货是不可能的。
    const ORDER_INVALID_OPERATION = 725;
    const ORDER_COMMENTED = 726;
    const ORDER_COMMENT_EXPIRED = 727;

    const GROUPON_EXPIRED = 730;
    const GROUPON_OFFLINE = 731;
    const GROUPON_FULL = 732;
    const GROUPON_JOIN = 733;

    const COUPON_EXCEED_LIMIT = 740;
    const COUPON_RECEIVE_FAIL = 741;
    const COUPON_CODE_INVALID = 742;

    const AFTERSALE_UNALLOWED = 750;
    const AFTERSALE_INVALID_AMOUNT = 751;
    const AFTERSALE_INVALID_STATUS = 752;
}
