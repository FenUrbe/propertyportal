<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestoreUserPlanBackupSeeder extends Seeder
{
    public function run(): void
    {
        $fileName = $this->command->ask('Enter the name of the backup file:');
        $backupFileName = $fileName . '.json';
        $backupFilePath = storage_path('app/backups/' . $backupFileName);

        if (!file_exists($backupFilePath)) {
            $this->command->error('Backup file not found: ' . $backupFileName);
            return;
        }

        $userPlansJson = file_get_contents($backupFilePath);

        $userPlansJsonArray = json_decode($userPlansJson, true);

        foreach ($userPlansJsonArray as $userPlans) {
            DB::table('user_plans')->insert($userPlans);
        }

        $this->command->info('User backup restored successfully.');
    }
}
