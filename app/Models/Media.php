<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Plank\Mediable\Media as MediableMedia;

class Media extends MediableMedia
{
    use HasFactory;

    public const VARIANT_NAME_THUMB = 'thumb';
    public const VARIANT_NAME_MEDIUM = 'medium';
    public const VARIANT_NAME_LARGE = 'large';
}
