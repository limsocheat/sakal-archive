<?php

namespace Modules\Product\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\ProductAttribute;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $items      = ProductAttribute::ordered()->get();

        $data       = [
            'items' => $items,
        ];

        return view('product::dashboard.attributes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data       = [
            'types' => ProductAttribute::getProductAttributeTypes(),
        ];

        return view('product::dashboard.attributes.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $data       = $request->all();
            $item       = ProductAttribute::create($data);

            if ($item) :
                DB::commit();
                flash()->success(__('Create product attribute successfully!'));
                return redirect()->route('dashboard.product_attributes.index');
            else :
                DB::rollback();
                flash()->error(__('Create product attribute failed!'));
                return redirect()->route('dashboard.product_attributes.index');
            endif;
        } catch (\Exception $e) {
            DB::rollback();
            flash()->error($e->getMessage());
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
    public function edit(ProductAttribute $productAttribute)
    {
        $data   = [
            'item'      => $productAttribute,
            'types'     => ProductAttribute::getProductAttributeTypes(),
        ];

        return view('product::dashboard.attributes.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, ProductAttribute $productAttribute)
    {
        DB::beginTransaction();

        try {

            $data       = $request->all();
            $productAttribute->update($data);

            if ($productAttribute) :
                DB::commit();
                flash()->success(__('Create product attribute successfully!'));
                return redirect()->back();
            else :
                DB::rollback();
                flash()->error(__('Create product attribute failed!'));
                return redirect()->back();
            endif;
        } catch (\Exception $e) {
            DB::rollback();
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
