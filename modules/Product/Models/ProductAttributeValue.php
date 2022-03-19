<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class ProductAttributeValue extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    /**
     * The attributes that should be fillable
     * 
     * @var array
     */
    protected $fillable = [
        'product_attribute_id',
        'name',
    ];

    /**
     * Get factory for the model.
     * 
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Product\Database\Factories\ProductAttributeValueFactory::new();
    }
}
