<?php

namespace Modules\Product\Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Contracts\Classes\Permissions;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $permissions = [
            Permissions::ALL_PRODUCTS, Permissions::CREATE_PRODUCTS, Permissions::VIEW_PRODUCTS, Permissions::EDIT_PRODUCTS, Permissions::DELETE_PRODUCTS, Permissions::RESTORE_PRODUCTS, Permissions::FORCE_DELETE_PRODUCTS,
            Permissions::ALL_PRODUCT_CATEGORIES, Permissions::CREATE_PRODUCT_CATEGORIES, Permissions::VIEW_PRODUCT_CATEGORIES, Permissions::EDIT_PRODUCT_CATEGORIES, Permissions::DELETE_PRODUCT_CATEGORIES, Permissions::RESTORE_PRODUCT_CATEGORIES, Permissions::FORCE_DELETE_PRODUCT_CATEGORIES,
            Permissions::ALL_PRODUCT_ATTRIBUTES, Permissions::CREATE_PRODUCT_ATTRIBUTES, Permissions::VIEW_PRODUCT_ATTRIBUTES, Permissions::EDIT_PRODUCT_ATTRIBUTES, Permissions::DELETE_PRODUCT_ATTRIBUTES, Permissions::RESTORE_PRODUCT_ATTRIBUTES, Permissions::FORCE_DELETE_PRODUCT_ATTRIBUTES,
            Permissions::ALL_PRODUCT_TAGS, Permissions::CREATE_PRODUCT_TAGS, Permissions::VIEW_PRODUCT_TAGS, Permissions::EDIT_PRODUCT_TAGS, Permissions::DELETE_PRODUCT_TAGS, Permissions::RESTORE_PRODUCT_TAGS, Permissions::FORCE_DELETE_PRODUCT_TAGS,
        ];

        foreach ($permissions as $permission) :
            Permission::updateOrCreate(
                ['name' => $permission, 'module' => 'product'],
                []
            );
        endforeach;
    }
}
