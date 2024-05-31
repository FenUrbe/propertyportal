<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestoreDBBackupSeeder extends Seeder
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

        $ubackupJson = file_get_contents($backupFilePath);

        $backupData = json_decode($ubackupJson, true);

        foreach ($backupData as $tableName => $tableData) {
            foreach ($tableData as $rowData) {
                DB::table($tableName)->insert($rowData);
            }
        }

        $this->command->info('Database backup restored successfully.');
    }
}
