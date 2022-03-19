<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseSuccess($data)
    {
        return response()->json([
            'success'   => true,
            'data'      => $data,
        ]);
    }

    public function responseError($data)
    {
        return response()->json([
            'success'   => false,
            'data'      => $data,
        ]);
    }
}
