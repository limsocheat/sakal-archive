<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\Flash\Flash;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{

		// To limit default string lenght in database
		Schema::defaultStringLength(191);

		/**
		 * Laravel Flash Levels
		 * 
		 * success, info, warning, danger
		 * @see https://github.com/spatie/laravel-flash
		 */
		Flash::levels([
			'success'   => 'green',
			'warning'   => 'yellow',
			'error'     => 'red',
			'info'      => 'indigo',
		]);

		Relation::enforceMorphMap([
			'user'  => User::class,
		]);
	}
}
