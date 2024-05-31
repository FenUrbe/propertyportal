<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserPlan;
use Carbon\Carbon;

class CheckSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-plans:check-subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check expiration of user plans';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredUserPlans = UserPlan::where('expires_at', '<', Carbon::now())
                                    ->where('status', 1)
                                    ->get();

        foreach ($expiredUserPlans as $expiredUserPlan) {
            $expiredUserPlan->status = 0;
            $expiredUserPlan->save();
        }

        $this->info('Expired user plans checked successfully.');
    }
}
