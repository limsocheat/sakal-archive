<?php

namespace Modules\Income\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IncomeCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that should be fillable
     * 
     * @var array
     */
    protected $fillable = [];

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
        return \Modules\Income\Database\Factories\IncomeCategoryFactory::new();
    }
}
