<?php

namespace Modules\Income\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that should be fillable
     * 
     * @var array
     */
    protected $fillable = [];
    
    /**
     * Get factory for the model.
     * 
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Income\Database\Factories\InvoiceFactory::new();
    }
}
