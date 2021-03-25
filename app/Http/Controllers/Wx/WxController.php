<?php

namespace App\Http\Controllers\Wx;

use App\CodeResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WxController extends Controller
{
    protected $only;

    protected $except;

    //
    public function __construct()
    {
        $option = [];
        !is_null($this->only) && $option['only'] = $this->only;
        !is_null($this->except) && $option['except'] = $this->except;
        $this->middleware('auth:wx', $option);
    }

    protected function codeReturn(array $codeResponse, $data = null, $info = '')
    {
        list($code, $message) = $codeResponse;
        $return = [
            'errno' => $code,
            'errmsg' => $info ?: $message,
        ];
        !is_null($data) && $return['data'] = $data;
        return response()->json($return);
    }

    protected function success($data = [], $info = '')
    {
        return $this->codeReturn(CodeResponse::SUCCESS, $data, $info);
    }

    protected function failure(array $codeResponse = CodeResponse::FAILURE, $info = '')
    {
        return $this->codeReturn($codeResponse, null, $info);
    }

    protected function user()
    {
        return Auth::guard('wx')->user();
    }

    public function successOrFail($isSuccess, array $codeResponse = CodeResponse::FAILURE, $data = null, $info = '')
    {
        return $isSuccess ? $this->success($data, $info) : $this->failure($codeResponse, $info);
    }
}
