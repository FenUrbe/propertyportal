<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserBackupSeeder extends Seeder
{
    public function run()
    {
        $users = DB::table('users')->get();
        
        $usersArray = $users->toArray();
        
        $fileName = $this->command->ask('Enter the name of the backup file:');
        $backupFileName = $fileName . '.json';
        $backupFilePath = storage_path('app/backups/' . $backupFileName);
        
        if (!file_exists(storage_path('app/backups'))) {
            mkdir(storage_path('app/backups'), 0777, true);
        }
        
        file_put_contents($backupFilePath, json_encode($usersArray));
        
        $this->command->info('User backup created successfully at: ' . $backupFilePath);
    }
}