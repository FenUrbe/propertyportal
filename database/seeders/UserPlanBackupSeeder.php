<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPlanBackupSeeder extends Seeder
{
    public function run(): void
    {
        $userPlans = DB::table('user_plans')->get();
        
        $userPlansArray = $userPlans->toArray();
        
        $fileName = $this->command->ask('Enter the name of the backup file:');
        $backupFileName = $fileName . '.json';
        $backupFilePath = storage_path('app/backups/' . $backupFileName);
        
        if (!file_exists(storage_path('app/backups'))) {
            mkdir(storage_path('app/backups'), 0777, true);
        }
        
        file_put_contents($backupFilePath, json_encode($userPlansArray));
        
        $this->command->info('User backup created successfully at: ' . $backupFilePath);
    }
}
