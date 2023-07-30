<?php

namespace App\Console\Commands;

use App\Models\Team;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a test';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        error_log('Hi');
        var_dump(Team::all());

        return Command::SUCCESS;
    }
}
