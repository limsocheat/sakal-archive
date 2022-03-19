<?php

namespace App\Http\Controllers\Dashboard\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        return view('dashboard.tools.index');
    }
}
