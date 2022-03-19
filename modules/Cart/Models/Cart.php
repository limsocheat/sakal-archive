<?php

namespace Modules\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;

class Cart extends Model
{
    use HasFactory;
    use BindsOnUuid;
    use GeneratesUuid;

    protected $fillable = [];

    /**
     * The attributes that should be cast to native types.
     * 
     * @var array
     */
    protected $casts = [];

    protected static function newFactory()
    {
        return \Modules\Cart\Database\Factories\CartFactory::new();
    }
}
