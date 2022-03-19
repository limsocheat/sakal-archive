<?php

namespace Modules\Income\Providers;

use App\Contracts\Constants\MenuConstant;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Modules\Customer\Models\Customer;
use Modules\Income\Models\Income;
use Modules\Income\Models\IncomeItem;
use Modules\Income\View\Component\Form\IncomeForm;
use Modules\Product\Models\Product;
use Lavary\Menu\Facade as Menu;
use Modules\Income\Models\IncomeCategory;
use Modules\Income\Models\Invoice;

class IncomeServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Income';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'income';

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
        $this->registerComponents();
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
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
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
     * Register Menus
     */
    private function registerMenus()
    {
        if ($menu = Menu::get(MenuConstant::NAME_DASHBOARD_DRAWER)) :

            $menu
                ->add(__('Incomes'), [
                    'route' => 'dashboard.incomes.index',
                ])
                ->nickname('incomes')
                ->before('<svg xmlns="http://www.w3.org/2000/svg" class="' . MenuConstant::CLASS_ICON . '" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>')
                ->data('order', 30);
            $menu
                ->get('incomes')
                ->add(__('All Incomes'), route('dashboard.incomes.index'));
            $menu
                ->get('incomes')
                ->add(__('Create Income'), route('dashboard.incomes.create'));

            $menu
                ->get('incomes')
                ->add(__('Categories'), route('dashboard.income_categories.create'));

            $menu->sortBy('order');
        endif;
    }

    /**
     * Register components
     * 
     * @return void
     */
    private function registerComponents()
    {
        Blade::component('income::form.income-form', IncomeForm::class);
    }

    /**
     * Register Relationships
     * 
     * @return void
     */
    private function registerRelationships()
    {
        Relation::enforceMorphMap([
            'income'            => Income::class,
            'income_category'   => IncomeCategory::class,
            'income_item'       => IncomeItem::class,
            'invoice'           => Invoice::class,
        ]);

        Income::resolveRelationUsing('items', function ($income) {
            return $income->hasMany(IncomeItem::class, 'income_id')->ordered();
        });

        Income::resolveRelationUsing('products', function ($income) {
            return $income->belongsToMany(Product::class, 'income_items', 'income_id', 'product_id')
                ->withPivot('name', 'description', 'quantity', 'price', 'discount', 'tax', 'sort_order')
                ->withTimestamps();
        });

        Income::resolveRelationUsing('incomeable', function ($income) {
            return $income->morphTo('incomeable');
        });

        IncomeItem::resolveRelationUsing('product', function ($item) {
            return $item->belongsTo(Product::class, 'product_id');
        });

        IncomeItem::resolveRelationUsing('income', function ($item) {
            return $item->belongsTo(Income::class, 'income_id');
        });

        Product::resolveRelationUsing('incomes', function ($product) {
            return $product->belongsToMany(Income::class, 'income_items', 'product_id', 'income_id')
                ->withPivot('name', 'description', 'quantity', 'price', 'discount', 'tax', 'sort_order')
                ->withTimestamps();
        });

        Product::resolveRelationUsing('income_items', function ($product) {
            return $product->hasMany(IncomeItem::class, 'product_id');
        });

        Customer::resolveRelationUsing('incomes', function ($customer) {
            return $customer->morphMany(Income::class, 'incomeable');
        });
    }
}
