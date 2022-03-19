<?php

namespace App\Services;

use Nwidart\Modules\Facades\Module;

class ModuleService
{
    public static function enable($module)
    {

        $m      = Module::findOrFail($module);

        foreach ($m->getRequires() as $require) :
            if (!Module::isEnabled($require)) :
                throw new \Exception("Module {$require} is required by {$module} and must be enabled first.");
            elseif (!Module::find($require)) :
                throw new \Exception("Module {$require} is required by {$module} and must be installed first.");
            endif;
        endforeach;

        Module::enable($module);
    }
}
