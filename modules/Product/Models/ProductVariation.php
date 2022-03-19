<?php

namespace Modules\Product\Models;

use Glorand\Model\Settings\Traits\HasSettingsField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class ProductVariation extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;
    use HasSettingsField;

    /**
     * The attributes that should be fillable
     * 
     * @var array
     */
    protected $fillable = [
        'product_id',
        'price',
    ];

    /**
     * Get factory for the model.
     * 
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Product\Database\Factories\ProductVariationFactory::new();
    }

    /**
     * ProductAttribute 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product_attribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }

    /**
     * ProductAttributeValue 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product_attribute_value()
    {
        return $this->belongsTo(ProductAttributeValue::class);
    }

    /**
     * Get product_attribute_name attribute
     * 
     * @return string
     */
    public function getProductAttributeNameAttribute()
    {

        return $this->product_attribute ? $this->product_attribute->name : null;
    }

    /**
     * Get product_attribute_value_name attribute
     * 
     * @return string
     */
    public function getProductAttributeValueNameAttribute()
    {
        return $this->product_attribute_value ? $this->product_attribute_value->name : null;
    }

    /**
     * Get product_variation_names attribute from settings
     * 
     * @return string
     */
    public function getProductVariationNamesAttribute()
    {

        $name               = '';
        $variations         = $this->settings()->get('variations');

        foreach ($variations as $key => $value) :
            $name           .= $key . ': ' . $value . ', ';
        endforeach;

        return  trim($name);
    }
}
