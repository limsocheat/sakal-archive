<?php

namespace Modules\Product\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Modules\Product\Models\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {

        $data               = [
            'product'                           => $product,
        ];

        return view('product::web.products.show', $data);
    }
}
