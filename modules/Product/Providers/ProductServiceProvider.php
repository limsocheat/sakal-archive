<?php

namespace Modules\Product\Providers;

use App\Contracts\Constants\MenuConstant;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Modules\Product\Contracts\Classes\Permissions;
use Lavary\Menu\Facade as Menu;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductAttribute;
use Modules\Product\Models\ProductAttributeValue;
use Modules\Product\Models\ProductAttributeValueItem;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductTag;
use Modules\Product\Models\ProductVariation;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Product';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'product';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->registerMenus();
        $this->registerRelationships();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'),
            $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }

    /**
     * Register navigation menu
     * 
     * @return void
     */
    private function registerMenus()
    {
        if ($menu = Menu::get(MenuConstant::NAME_DASHBOARD_DRAWER)) :

            $menu
                ->add(__('Products'), [
                    'route' => 'dashboard.products.index',
                ])
                ->nickname('products')
                ->before('<svg xmlns="http://www.w3.org/2000/svg" class="' . MenuConstant::CLASS_ICON . '" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                  </svg>')
                ->data('order', 10);
            $menu
                ->get('products')
                ->add(__('All Products'), route('dashboard.products.index'));
            $menu
                ->get('products')
                ->add(__('Create Products'), route('dashboard.products.create'));
            $menu
                ->get('products')
                ->add(__('Categories'), route('dashboard.product_categories.create'));
            $menu
                ->get('products')
                ->add(__('Tags'), route('dashboard.product_tags.create'));
            $menu
                ->get('products')
                ->add(__('Attributes'), route('dashboard.product_attributes.create'));

            $menu->sortBy('order');
        endif;
    }

    /**
     * Register relationships
     * 
     * @return void
     */
    private function registerRelationships()
    {
        Relation::enforceMorphMap([
            'product'                       => Product::class,
            'product_attribute'             => ProductAttribute::class,
            'product_attribute_value'       => ProductAttributeValue::class,
            'product_attribute_value_item'  => ProductAttributeValueItem::class,
            'product_brand'                 => ProductBrand::class,
            'product_category'              => ProductCategory::class,
            'product_tag'                   => ProductTag::class,
            'product_variation'             => ProductVariation::class,
        ]);
    }
}
