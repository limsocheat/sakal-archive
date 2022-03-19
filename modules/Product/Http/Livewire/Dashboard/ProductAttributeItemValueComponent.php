<?php

namespace Modules\Product\Http\Livewire\Dashboard;

use Livewire\Component;
use Modules\Product\Models\ProductAttributeValueItem;

class ProductAttributeItemValueComponent extends Component
{

    public $product;
    public $item;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function setItem($item)
    {
        $this->item = $item;
    }

    public function render()
    {
        $attribute_value_items      = ProductAttributeValueItem::where('product_id', $this->product->id)->get();

        return view('product::livewire.dashboard.product-attribute-item-value-component', [
            'attribute_value_items' => $attribute_value_items,
        ]);
    }
}
