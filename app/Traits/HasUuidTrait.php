<?php

namespace App\Traits;

use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;

trait HasUuidTrait
{
    use BindsOnUuid;
    use GeneratesUuid;

    /**
     * Initialize the has uuid trait for an instance.
     *
     * @return void
     */
    public function initializeHasUuidTrait()
    {
        // if (!isset($this->casts['uuid'])) {
        //     $this->casts['uuid'] = EfficientUuid::class;
        // }
    }

    public static function findByUuidOrFail($uuid)
    {
        return self::whereUuid($uuid)->firstOrFail();
    }
}
