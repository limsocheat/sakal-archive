<?php

namespace Modules\Academic\Providers;

use App\Contracts\Constants\MenuConstant;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Academic\Models\AcademicCard;
use Modules\Academic\Models\AcademicSchedule;
use Modules\Academic\Models\AcademicTerm;
use Modules\Academic\Models\AcademicYear;
use Modules\Academic\Models\Faculty;
use Modules\Academic\Models\Major;
use Modules\Student\Models\Student;
use Lavary\Menu\Facade as Menu;

class AcademicServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Academic';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'academic';

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
                ->add(__('Academics'), [
                    'route' => 'dashboard.majors.index',
                ])
                ->before('<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                  </svg>')
                ->data('order', 10);
            $menu
                ->get('academics')
                ->add(__('Majors'), route('dashboard.majors.index'));
            // $menu
            //     ->get('students')
            //     ->add(__('Create Student'), route('dashboard.students.create'));
            // $menu
            //     ->get('students')
            //     ->add(__('Registration'), route('dashboard.registrations.create'));

            // $menu
            //     ->get('settings')
            //     ->add(__('Student Setting'), LaravelLocalization::localizeUrl('dashboard/settings/students'));

            $menu->sortBy('order');
        endif;
    }

    /**
     * Register relationships.
     * 
     * @return void
     */
    private function registerRelationships()
    {
        Relation::enforceMorphMap([
            'academic_schedule'         => AcademicSchedule::class,
            'academic_term'             => AcademicTerm::class,
            'academic_year'             => AcademicYear::class,
            'classroom'                 => AcademicSchedule::class,
            'faculty'                   => Faculty::class,
            'major'                     => Major::class,
        ]);

        AcademicCard::resolveRelationUsing('student', function ($academicCard) {
            return $academicCard->belongsTo(Student::class, 'student_id', 'id');
        });
    }
}
