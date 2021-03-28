<?php

namespace App\Http\Controllers\Wx;

use App\CodeResponse;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
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

    protected function successOrFail($isSuccess, array $codeResponse = CodeResponse::FAILURE, $data = null, $info = '')
    {
        return $isSuccess ? $this->success($data, $info) : $this->failure($codeResponse, $info);
    }

    protected function paginate($list)
    {
        if ($list instanceof LengthAwarePaginator) {
            return [
                'total' => $list->total(),
                'page' => $list->currentPage(),
                'limit' => $list->perPage(),
                'pages' => $list->lastPage(),
                'list' => $list ? $list->items() : [],
            ];
        }
        if ($list instanceof Collection) {
            return [
                'total' => $list->count(),
                'page' => 1,
                'limit' => $list->count(),
                'pages' => 1,
                'list' => $list ? $list->toArray() : [],
            ];
        }
        if (is_array($list)) {
            $total = count($list);
            return [
                'total' => $total,
                'page' => 1,
                'limit' => $total,
                'pages' => 1,
                'list' => $list ?: [],
            ];
        }
    }

    protected function successPaginate($list)
    {
        return $this->success($this->paginate($list));
    }

    protected function isLogin()
    {
        return !is_null($this->user());
    }
}
