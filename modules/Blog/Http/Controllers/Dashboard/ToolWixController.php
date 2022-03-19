<?php

namespace Modules\Blog\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ToolWixController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index()
    {
        return view('blog::dashboard.tools.wix_import');
    }

    /**
     * Display wix posts import tool form 
     * 
     * @return View
     */
    public function posts()
    {
        return view('blog::dashboard.tools.wix_import_posts');
    }

    /**
     * Display wix categories import tool form 
     * 
     * @return View
     */
    public function categories()
    {
        return view('blog::dashboard.tools.wix_import_categories');
    }
}
