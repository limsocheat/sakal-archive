<?php

namespace Modules\Product\Http\Controllers\Dashboard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductAttributeValueItem;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductVariation;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $items      = Product::get();

        $data       = [
            'items'     => $items,
        ];

        return view('product::dashboard.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data       = [
            'types'     => Product::getTypes(),
        ];

        return view('product::dashboard.products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => ['required'],
            'description'   => ['required'],
        ]);

        try {
            $product        = Product::create($request->all());
            if ($product) :
                flash()->warning(__('Product created successfully'));
            else :
                flash()->warning(__('Product not created'))->error();
            endif;
            return redirect()->route('dashboard.products.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('product::dashboard.products.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Product $product)
    {

        $data       = [
            'item'                      => $product,
            'types'                     => Product::getTypes(),
            'categories'                => ProductCategory::get()->pluck('name', 'id'),
        ];

        return view('product::dashboard.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'          => ['required'],
            'description'   => ['nullable'],
        ]);

        try {
            $data       = $request->all();
            $product->update($data);
            if ($product) :
                $product->syncFeaturedImageById($request->input('featured_image_id'));
                flash()->success(__('Product updated successfully'));
            else :
                flash()->warning(__('Product not updated'));
            endif;
            return redirect()->back();
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
