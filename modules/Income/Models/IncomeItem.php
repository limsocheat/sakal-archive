<?php

namespace Modules\Income\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class IncomeItem extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    /**
     * The attributes that should be fillable
     * 
     * @var array
     */
    protected $fillable = [
        'income_id',
        'product_id',
        'name',
        'description',
        'quantity',
        'price',
        'discount',
        'tax',
        'sort_order',
    ];


    /**
     * Get factory for the model.
     * 
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Income\Database\Factories\IncomeItemFactory::new();
    }

    /**
     * Get subtotal attribute
     * 
     * @return float
     */
    public function getSubtotalAttribute()
    {
        return ($this->quantity * $this->price) - $this->discount;
    }

    /**
     * build sort query
     */
    public function buildSortQuery()
    {
        return static::query()->where('income_id', $this->income_id);
    }
}
