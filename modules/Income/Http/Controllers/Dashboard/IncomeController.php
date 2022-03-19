<?php

namespace Modules\Income\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Income\Models\Income;
use Modules\Product\Models\Product;
use Spatie\QueryBuilder\QueryBuilder;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $incomes        = QueryBuilder::for(Income::class)
            ->get();

        return view('income::dashboard.incomes.index', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('income::dashboard.incomes.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'code'          => ['required'],
            'date'          => ['required'],
            'due_date'      => ['required'],
            'items'         => ['required', 'array'],
        ]);

        DB::beginTransaction();

        try {

            $data               = $request->except('items');
            $data['date']       = date('Y-m-d', strtotime($data['date']));
            $data['due_date']   = date('Y-m-d', strtotime($data['due_date']));

            $income     = Income::create($data);
            if (!$income) :
                DB::rollBack();
                flash()->error(__('Error creating income'));
                return redirect()->back();
            endif;

            $items      = [];
            foreach ($request->input('items') as $line) :
                $product            = Product::find($line['product_id']);
                $items[$line['product_id']] = [
                    'name'          => $product->name,
                    'description'   => $product->description,
                    'quantity'      => $line['quantity'],
                    'price'         => $line['price'],
                    'sort_order'    => $line['sort_order'],
                ];
            endforeach;

            $income->products()->sync($items);
            DB::commit();
            flash()->success(__('Income created successfully'));
            return redirect()->route('dashboard.incomes.index');
        } catch (\Exception $e) {
            DB::rollback();
            flash()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     * @param Income $income
     * @return Renderable
     */
    public function show(Income $income)
    {
        return view('income::dashboard.incomes.show', compact('income'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Income $income
     * @return Renderable
     */
    public function edit(Income $income)
    {
        return view('income::dashboard.incomes.edit', compact('income'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Income $income
     * @return Renderable
     */
    public function update(Request $request, Income $income)
    {
        $request->validate([
            'code'          => ['required'],
            'date'          => ['required'],
            'due_date'      => ['required'],
            'items'         => ['required', 'array'],
        ]);

        DB::beginTransaction();

        try {

            $data               = $request->except('items');
            $data['date']       = date('Y-m-d', strtotime($data['date']));
            $data['due_date']   = date('Y-m-d', strtotime($data['due_date']));

            $income->update($data);
            if (!$income) :
                DB::rollBack();
                flash()->error(__('Error creating income'));
                return redirect()->back();
            endif;

            $items      = [];
            foreach ($request->input('items') as $line) :
                $product            = Product::find($line['product_id']);
                $items[$line['product_id']] = [
                    'name'          => $product->name,
                    'description'   => $product->description,
                    'quantity'      => $line['quantity'],
                    'price'         => $line['price'],
                    'sort_order'    => $line['sort_order'],
                ];
            endforeach;

            $income->products()->sync($items);
            DB::commit();
            flash()->success(__('Income updated successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            flash()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Income $income
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
