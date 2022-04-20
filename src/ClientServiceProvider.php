<?php

namespace Egent\Client;

use Egent\Office\Commands\Install;
use Egent\Office\Components\OfficeListings;
use Egent\Office\Models\Office;
use Egent\Office\Policies\OfficePolicy;
use Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider
{
    /**
     * Event Listeners
     * @var \string[][]
     */
    protected $listen = [
    ];

	/**
	 * Boot the package.
	 */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'client');
		return;
		$this->bootCommands();
		$this->bootPolicy();
		$this->bootRoutes();
        $this->bootComponents();
    }
	/**
	 * Bring out commands online.
	 */
	protected function bootCommands() : void {
		$this->commands([
			Install::class
		]);
	}

	/**
	 * Boot all components.
	 */
	private function bootComponents() : void
	{
		$prefix = '';
		$this->callAfterResolving(\Illuminate\View\Compilers\BladeCompiler::class, function ($blade) use ($prefix) {
			$components = [
				'office-user-pending-membership' => \Egent\Office\Components\UserPendingMemberships::class,
				'office-clients' => \Egent\Office\Components\OfficeClients::class,
				'office-listings' => \Egent\Office\Components\OfficeListings::class,
				'office-users' => \Egent\Office\Components\OfficeUsers::class
			];
			foreach ($components as $alias => $component) {
				$blade->component($component, is_string($alias) ? $alias : null, $prefix);
			}
		});
	}
	/**
	 * Bring our policies online.
	 */
	protected function bootPolicy() : void {
//		Gate::define('transaction-policy', [TransactionPolicy::class, 'show']);
///		Gate::policy('transaction-policy', function($user) { return true; });//[TransactionPolicy::class, 'view']);
		if ($temp = \Config::get('office.policy')) {
			Gate::policy(Office::class, $temp);
		}
	}

	/**
	 * Bring our routes online.
	 */
	protected function bootRoutes() : void {
		Route::group([
			'middleware' => ['web']
		], function() {
			$this->loadRoutesFrom(__DIR__.'/Routes/web.php');
		});
	}

	/**
	 * Register the package.
	 */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/config.php', 'client');

    }
}