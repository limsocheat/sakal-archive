<?php

namespace Modules\Product\Models;

use Glorand\Model\Settings\Traits\HasSettingsField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttributeValueItem extends Model
{
    use HasFactory;
    use HasSettingsField;

    /**
     * The attributes that should be fillable
     * 
     * @var array
     */
    protected $fillable = [
        'product_id',
        'product_attribute_id',
        'product_attribute_value_id',
        'active',
    ];

    /**
     * Get factory for the model.
     * 
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Product\Database\Factories\ProductAttributeValueItemFactory::new();
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
        return $this->product_attribute->name;
    }

    /**
     * Get product_attribute_value_name attribute
     * 
     * @return string
     */
    public function getProductAttributeValueNameAttribute()
    {
        return $this->product_attribute_value->name;
    }
}
