<?php

namespace Modules\Product\Http\Livewire\Web;

use Livewire\Component;
use Modules\Product\Models\ProductAttributeValueItem as ProductAttributeValueItemModel;
use Modules\Product\Models\ProductVariation;

class ProductAttributeValueItem extends Component
{

    public $product;
    public $settings    = [];

    protected $queryString = ['settings'];

    public function __construct($product)
    {
        $this->product          = $product;
    }

    public function render()
    {

        /**
         * @var ProductVariation $variation
         * @var ProductAttributeValueItem $attributes
         * @var String $message
         */
        $variation              = null;
        $message                = null;
        $attributes             = ProductAttributeValueItemModel::where('product_id', $this->product->id)->get();
        $attributes             = $attributes->groupBy('product_attribute.name')->toBase();

        $query                  = ProductVariation::where('product_id', $this->product->id);
        foreach ($this->settings as $key => $value) :
            $query->where('settings->variations->' . $key, $value);
        endforeach;
        $variations             = $query->get();

        /** 
         * make sure customer chose all required attributes
         * by comparing the number of attributes in the product
         * with the number of attributes in the variations
         * 
         * if not equal, then the customer didn't choose all required attributes
         * then set the message
         */
        if (count($this->settings) < $this->product->product_attribute_group_count) :
            $message            = __('Please select all the attributes');
        elseif (count($this->settings) == $this->product->product_attribute_group_count) :

            /**
             * if variation is found and equal to one, then set the variation
             * else, set the message
             */
            if (count($variations) == 1) :
                $variation          = $variations->first();
            else :
                $message            = __('No variation found');
            endif;
        endif;

        return view('product::livewire.web.product-attribute-value-item', [
            'attributes'        => $attributes,
            'variations'        => $variations,
            'variation'         => $variation,
            'message'           => $message,
        ]);
    }
}
