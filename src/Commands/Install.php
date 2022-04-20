<?php

namespace Egent\Client\Commands;

use App\Enum\DocumentTypeStatus;
use App\Jobs\DocumentType\Process;
use App\Models\DocumentType;
use Egent\Contract\Models\Document;
use Illuminate\Console\Command;
use Spatie\Activitylog\Models\Activity;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'client:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install this package.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		$this->handleMigrations();
    }
	/**
	 * This is an ugly way to run migrations in our package via the install command.
	 * Detect what is here.
	 * Detect what has ran.
	 * Run what hasn't been ran.
	 */
	protected function handleMigrations() : void {
		$path = dirname(__DIR__).'/Database/Migrations/';
		$files = glob($path.'*.php');
		$basenames = array_map(function($e) { return basename($e); }, $files);
		$basenames = array_combine(array_map(function($e) {
			return preg_replace('#^.*?([a-z].*?)\.php$#','$1', $e);
		}, $basenames), $basenames);
		$existing = \DB::table('migrations')->where(function($sub) use ($basenames) {
			foreach($basenames as $k => $v) {
				$sub->orWhere('migration','like','%'.$k);
			}
		})->select('migration')->get()->pluck('migration');
		foreach($existing as $k) {
			$k = preg_replace('#^.*?([a-z])#','$1', $k);
			unset($basenames[$k]);
		}
		$x = strlen(base_path(''));
		foreach($basenames as $base => $basename) {
			$file = substr($path.$basename, $x);
			$this->info('Migrating: '.$basename);
			\Artisan::call('migrate', ['--path' => $file]);
		}
	}

}
