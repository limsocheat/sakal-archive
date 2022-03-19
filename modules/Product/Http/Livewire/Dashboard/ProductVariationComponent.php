<?php

namespace Modules\Product\Http\Livewire\Dashboard;

use Livewire\Component;
use Modules\Product\Models\ProductAttributeValueItem;

class ProductVariationComponent extends Component
{

    public $product;
    public $variations = [];
    public $attributes = [];

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function mount()
    {
        $this->variations       = $this->product->variations ?? [];

        $attributes             = ProductAttributeValueItem::where('product_id', $this->product->id)->get();
        $attributes             = $attributes->groupBy('product_attribute.name')->toBase();
        $this->attributes       = $attributes ?? [];
    }

    public function render()
    {
        return view('product::livewire.dashboard.product-variation-component');
    }
}
