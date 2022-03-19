<?php

namespace Modules\Product\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\ProductAttribute;
use Modules\Product\Models\ProductAttributeValue;

class ProductAttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ProductAttribute $productAttribute)
    {

        $data       = [
            'productAttribute'  => $productAttribute,
            'items'             => ProductAttributeValue::where('product_attribute_id', $productAttribute->id)->ordered()->get(),
        ];

        return view('product::dashboard.attributes.values.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('product::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request, ProductAttribute $productAttribute)
    {

        $request->validate([
            'value'     => 'required',
        ]);

        DB::beginTransaction();

        try {

            $data       = $request->all();
            $data['product_attribute_id'] = $productAttribute->id;

            $value      = ProductAttributeValue::create($data);

            if ($value) {
                DB::commit();
                return redirect()->route('dashboard.product_attribute_values.index', $productAttribute);
            }
            DB::commit();
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            DB::rollback();
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('product::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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
