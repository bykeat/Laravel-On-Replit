<?php

namespace App\Console\Commands;

use App\Models\Team;
use App\Models\User;
use Error;
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
        $maxUserId = User::max('id');
        $maxTeamId = Team::max('id');

        $messages[] = "Max user id: $maxUserId";
        $messages[] = "Max team id: $maxTeamId";

        foreach ($messages as $message) {
            error_log(json_encode($message));
        }

        return Command::SUCCESS;
    }
}
