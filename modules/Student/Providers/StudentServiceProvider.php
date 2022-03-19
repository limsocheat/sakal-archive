<?php

namespace Modules\Student\Providers;

use App\Contracts\Constants\MenuConstant;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Student\Models\Student;
use Lavary\Menu\Facade as Menu;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class StudentServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Student';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'student';

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

        /**
         * Append guard to auth config
         */
        config(['auth.guards' => array_merge(config('auth.guards'), [
            'student' => [
                'driver'    => 'session',
                'provider'  => 'students',
            ],
        ])]);

        config(['auth.providers' => array_merge(config('auth.providers'), [
            'students' => [
                'driver' => 'eloquent',
                'model' => Student::class,
            ],
        ])]);
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
     * Register navigation menu
     * 
     * @return void
     */
    private function registerMenus()
    {
        if ($menu = Menu::get(MenuConstant::NAME_DASHBOARD_DRAWER)) :

            $menu
                ->add(__('Students'), [
                    'route' => 'dashboard.students.index',
                ])
                ->before('<svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>')
                ->data('order', 10);
            $menu
                ->get('students')
                ->add(__('All Students'), route('dashboard.students.index'));
            $menu
                ->get('students')
                ->add(__('Create Student'), route('dashboard.students.create'));
            $menu
                ->get('students')
                ->add(__('Registration'), route('dashboard.registrations.create'));

            $menu
                ->get('settings')
                ->add(__('Student Setting'), LaravelLocalization::localizeUrl('dashboard/settings/students'));

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
            'student'  => Student::class,
        ]);
    }
}
