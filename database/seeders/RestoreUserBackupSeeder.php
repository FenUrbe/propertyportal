<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestoreUserBackupSeeder extends Seeder
{
    public function run()
    {
        $fileName = $this->command->ask('Enter the name of the backup file:');
        $backupFileName = $fileName . '.json';
        $backupFilePath = storage_path('app/backups/' . $backupFileName);

        if (!file_exists($backupFilePath)) {
            $this->command->error('Backup file not found: ' . $backupFileName);
            return;
        }

        $usersJson = file_get_contents($backupFilePath);

        $usersArray = json_decode($usersJson, true);

        foreach ($usersArray as $user) {
            DB::table('users')->insert($user);
        }

        $this->command->info('User backup restored successfully.');
    }
}


