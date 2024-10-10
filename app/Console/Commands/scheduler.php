<?php

namespace App\Console\Commands;

use App\Jobs\ScheduleJob;
use Illuminate\Console\Command;

class scheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will dispatch the email notification job in everyday at 9PM';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ScheduleJob::dispatch();
    }
}
