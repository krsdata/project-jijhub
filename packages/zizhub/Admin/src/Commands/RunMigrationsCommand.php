<?php

namespace Zizhub\Admin\Commands;

use Illuminate\Console\Command;

class RunMigrationsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'zizhub:run-migrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the zizhub migrations';

    /**
     * Execute the command.
     */
    public function fire()
    {
        $this->call('migrate', [
            '--path' => 'packages/zizhub/Admin/src/migrations',
        ]);
    }
}
 
