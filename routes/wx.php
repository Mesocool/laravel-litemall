<?php

/**
 *
 * ----------------------------------- PHP -----------------------------------
 *                              PHP是世界上最好的语言
 * ===========================================================================
 * @created          PhpStorm
 * ===========================================================================
 * @file             wx.php
 * ===========================================================================
 * @author           zhoushuaishuai <zhouqu@vmcshop.com>
 * ===========================================================================
 * @ctime:           2021/3/24 上午10:40
 * ===========================================================================
 * @version          1.0
 * ===========================================================================
 *
 * ----------------------------------- PHP -----------------------------------
 *
 */

use Illuminate\Support\Facades\Route;

// 注册验证码
Route::post('auth/regCaptcha', 'AuthController@registerCaptcha');
// 用户注册
Route::post('auth/register', 'AuthController@register');
// 用户登录
Route::post('auth/login', 'AuthController@login');
// 用户信息
Route::get('auth/info', 'AuthController@info');
// 用户登出
Route::any('auth/logout', 'AuthController@logout');
// 用户重置密码
Route::post('auth/reset', 'AuthController@reset');
// 用户修改信息
Route::post('auth/profile', 'AuthController@profile');

Route::get('address/list', 'AddressController@list');

Route::post('address/save', 'AddressController@save');

Route::post('address/delete', 'AddressController@delete');

Route::any('address/detail', 'AddressController@detail');
