<?php

namespace Modules\Cart\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Cart\Models\Cart;
use Modules\Cart\Transformers\Api\V1\CartResource;

class CartController extends Controller
{
    public function index(Request $request)
    {
        try {
            $cart         = Cart::firstOrCreate(
                [
                    'instance'      => $request->input('instance'),
                    'outlet_id'     => $request->input('outlet_id'),
                    'customer_id'   => $request->user()->id,
                ],
                []
            );

            $cart->calculate();
            $item               = new CartResource($cart);

            DB::commit();
            return $this->responseSuccess($item);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->responseError($e->getMessage());
        }
    }
}
