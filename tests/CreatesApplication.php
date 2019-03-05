<?php

namespace Tests;

use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Console\Kernel as Artisan;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    protected static $migrationsRun = false;

    /** @var Artisan */
    private $artisan;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $this->artisan = $app->make(Artisan::class);
        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    private function prepareForTests()
    {
        Config::set('database.default', 'mysql_testing');

        if (!static::$migrationsRun)
        {
            $this->artisan->call('migrate:refresh', ['--database' => 'mysql_testing']);
            static::$migrationsRun = true;
        }
    }
}
