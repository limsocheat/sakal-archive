<?php

namespace Modules\Blog\Providers;

use App\Contracts\Constants\MenuConstant;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Modules\Blog\View\Component\Form\PostForm;
use Lavary\Menu\Facade as Menu;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Page;
use Modules\Blog\Models\Post;
use Modules\Blog\Models\Tag;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Blog';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'blog';

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
                ->add(__('blog::label.blog'), [
                    'route' => 'dashboard.posts.index',
                ])
                ->nickname('blogs')
                ->before('<svg xmlns="http://www.w3.org/2000/svg" class="' . MenuConstant::CLASS_ICON . '" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
              </svg>')->data('order', 10);

            $menu->get('blogs')->add(__('All Posts'), route('dashboard.posts.index'));
            $menu->get('blogs')->add(__('Create Post'), route('dashboard.posts.create'));
            $menu->get('blogs')->add(__('Categories'), route('dashboard.categories.index'));
            $menu->get('blogs')->add(__('Tags'), route('dashboard.tags.index'));
            $menu->get('blogs')->add(__('Pages'), route('dashboard.pages.index'));

            $menu->get('tools')->add(__('WIX Import'), LaravelLocalization::localizeUrl('dashboard/tools/wix_import'));

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
        Blade::component('blog::form.post-form', PostForm::class);
    }

    /**
     * Register relationships
     * 
     * @return void
     */
    private function registerRelationships()
    {
        Relation::enforceMorphMap([
            'category'  => Category::class,
            'page'      => Page::class,
            'post'      => Post::class,
            'tag'       => Tag::class,
        ]);
    }
}
