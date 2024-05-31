<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestoreUpgradePlanBackupSeeder extends Seeder
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

        $upgradePlansJson = file_get_contents($backupFilePath);

        $upgradePlansArray = json_decode($upgradePlansJson, true);

        foreach ($upgradePlansArray as $upgradePlans) {
            DB::table('upgrade_plans')->insert($upgradePlans);
        }

        $this->command->info('User backup restored successfully.');
    }
}
