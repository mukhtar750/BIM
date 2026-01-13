<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ElectionDataSeeder extends Seeder
{
    public function run(): void
    {
        $sqlPath = database_path('bincom_test.sql');
        if (!File::exists($sqlPath)) {
            $this->command->error("SQL file not found at: {$sqlPath}");
            return;
        }

        $sql = File::get($sqlPath);
        
        // Split by semicolon followed by a newline or end of string
        $statements = preg_split('/;(?:\s*[\r\n]+|$)/', $sql);

        $this->command->info("Found " . count($statements) . " statements. Importing...");

        foreach ($statements as $statement) {
            $statement = trim($statement);
            
            if (empty($statement)) {
                continue;
            }

            // Only run INSERT statements
            if (preg_match('/INSERT\s+INTO/i', $statement)) {
                $this->command->info("Executing INSERT statement...");
                // Handle MySQL specific date '0000-00-00 00:00:00' for SQLite
                $statement = str_replace("'0000-00-00 00:00:00'", "'2011-01-01 00:00:00'", $statement);
                
                try {
                    DB::unprepared($statement . ';');
                } catch (\Exception $e) {
                    $this->command->error("Failed to execute: " . $e->getMessage());
                }
            } else {
                $this->command->line("Skipping non-INSERT statement: " . substr($statement, 0, 30));
            }
        }
        
        $this->command->info("Import completed.");
    }
}
