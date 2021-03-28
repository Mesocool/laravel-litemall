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
// 地址列表
Route::get('address/list', 'AddressController@list');
// 地址保存
Route::post('address/save', 'AddressController@save');
// 地址删除
Route::post('address/delete', 'AddressController@delete');
//地址详情
Route::any('address/detail', 'AddressController@detail');
// 分类列表
Route::get('catalog/index', 'CatalogController@index');
// 当前分类
Route::get('catalog/current', 'CatalogController@current');
// 品牌列表
Route::get('brand/list', 'BrandController@list');
// 品牌详情
Route::get('brand/detail', 'BrandController@detail');

Route::get('goods/category', 'GoodsController@category');

Route::get('goods/list', 'GoodsController@list');
Route::get('goods/count', 'GoodsController@count');
Route::get('goods/detail', 'GoodsController@detail');
