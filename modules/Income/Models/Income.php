<?php

namespace Modules\Income\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;

class Income extends Model
{
    use HasFactory;
    use BindsOnUuid;
    use GeneratesUuid;

    /**
     * The attributes that should be fillable
     * 
     * @var array
     */
    protected $fillable = [
        'incomeable_id',
        'incomeable_type',
        'code',
        'date',
        'due_date',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     * 
     * @var array
     */
    protected $casts = [];

    /**
     * Get factory for the model.
     * 
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Income\Database\Factories\IncomeFactory::new();
    }

    /**
     * get total attribute
     * 
     * @return float
     */
    public function getTotalAttribute()
    {
        $total = 0;

        foreach ($this->items as $item) :
            $total += $item->subtotal;
        endforeach;

        return $total;
    }
}
