<?php

namespace App\Console\Commands;

use App\Enum\SubscribeStatusEnum;
use Carbon\Carbon;
use Illuminate\Console\Command;
use SLIM\Trainee\App\Models\TraineeSubscribe;

class CheckExpiredSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:check-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the current date and time
        $now = Carbon::now()->format('Y-m-d');

        // Find subscriptions that have expired
         TraineeSubscribe::where('end_date', '<', $now)
            ->where('is_active', 1) // Assuming 'active' is the status of non-expired subscriptions
            ->update(['subscribe_status' => SubscribeStatusEnum::FINISHED->value]);
    }
}
