<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DBBackupSeeder extends Seeder
{
    public function run(): void
    {
        $users = DB::table('users')->get();
        $upgradePlans = DB::table('upgrade_plans')->get();
        $userPlans = DB::table('user_plans')->get();

        
        $usersArray = $users->toArray();
        $upgradePlansArray = $upgradePlans->toArray();
        $userPlansArray = $userPlans->toArray();

        $combinedData = [
            'users' => $usersArray,
            'upgrade_plans' => $upgradePlansArray,
            'user_plans' => $userPlansArray,
        ];
        
        $fileName = $this->command->ask('Enter the name of the backup file:');
        $backupFileName = $fileName . '.json';
        $backupFilePath = storage_path('app/backups/' . $backupFileName);
        
        if (!file_exists(storage_path('app/backups'))) {
            mkdir(storage_path('app/backups'), 0777, true);
        }
        
        file_put_contents($backupFilePath, json_encode($combinedData));
        
        $this->command->info('Database backup created successfully at: ' . $backupFilePath);
    }
}
