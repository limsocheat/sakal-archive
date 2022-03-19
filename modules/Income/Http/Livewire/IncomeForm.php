<?php

namespace Modules\Income\Http\Livewire;

use Livewire\Component;
use Modules\Product\Models\Product;

class IncomeForm extends Component
{
    public $new;
    public $items;
    public $products = [];

    public function __construct($items = [])
    {
        $this->items = $items ?? [];
    }

    public function mount()
    {
        $this->new = [
            'product_id'    => null,
            'description'   => null,
            'quantity'      => 1,
            'price'         => 0,
            'discount'      => 0,
        ];

        $this->products     = Product::get()->pluck('name', 'id');
    }


    public function updatedItems()
    {
        $items      = [];
        foreach ($this->items as $item) :
            $subtotal           = $item['quantity'] * $item['price'];

            $items              = array_merge($item, [
                'subtotal' => $subtotal,
            ]);

        endforeach;

        $this->items = $items;
    }

    public function addProduct()
    {
        $item               = $this->new;
        $item['sort_order'] = count($this->items) + 1;

        $this->items[]      = $item;

        $this->new = [
            'product_id'    => null,
            'description'   => '',
            'quantity'      => 1,
            'price'         => 0,
            'discount'      => 0,
        ];
    }

    /**
     * Change product
     * 
     * Find product by id and set it to item with description and price
     */
    public function changeProduct()
    {
        $product            = Product::find($this->new['product_id']);

        $this->new         = array_merge($this->new, [
            'description'   => $product->description,
            'price'         => $product->price,
        ]);
    }

    /**
     * Remove item 
     * 
     * @param int $index
     */
    public function removeItem($index)
    {
        array_splice($this->items, $index, 1);
    }

    public function render()
    {
        $total = 0;
        foreach ($this->items as $item) :
            $total += $item['price'] * $item['quantity'];
        endforeach;

        return view('income::livewire.income-form', [
            'total' => $total,
        ]);
    }

    public function reorderItems($lists)
    {

        $items      = [];
        foreach ($lists as $list) :
            $item               = $this->items[$list['value']];
            $item['sort_order'] = $list['order'];
            $items[]            = $item;
        endforeach;

        $this->items    = $items;
    }
}
