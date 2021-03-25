<?php

namespace App\Http\Controllers;

use App\Facades\Product;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    //

    public function collectTest()
    {
        $a = collect(['k1' => 'v1', 'k2' => 'v2', 'k3' => 'v3'])->count();
        dd($a);
    }

    public function cacheTest( )
    {
//        $res = Cache::put('key','value',now()->addMinutes(1));
//        $res = Cache::forget('key');
//        dd($res);
//        Arr::
//        data_fill()
//        Str::
//        e();
//        dd(Product::getProductId(11));
//        return ['code'=>0];
    }
}
