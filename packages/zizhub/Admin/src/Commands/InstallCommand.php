<?php

namespace Zizhub\Admin\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'zizhub:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the zizhub migrations';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->info('Checking Database Schema');

        $this->call('zizhub:check-schema');

        $this->info('Running migrations');

        $this->call('zizhub:run-migrations');

        $this->info('zizhub has been successfully installed');
    }
}
