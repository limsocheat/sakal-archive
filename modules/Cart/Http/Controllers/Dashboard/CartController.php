<?php

namespace Modules\Cart\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Cart\Models\Cart;

class CartController extends Controller
{

    public function index()
    {

        $items      = Cart::get();

        $data       = [
            'items' => $items,
        ];

        return view('cart::dashboard.cart.index', $data);
    }
}
