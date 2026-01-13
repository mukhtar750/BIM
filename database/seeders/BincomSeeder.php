<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BincomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sqlPath = database_path('bincom_test.sql');
        if (!file_exists($sqlPath)) {
            $this->command->error("SQL file not found at $sqlPath");
            return;
        }

        $handle = fopen($sqlPath, 'r');
        $currentTable = '';
        $insertBuffer = '';

        while (($line = fgets($handle)) !== false) {
            $line = trim($line);
            if (empty($line) || str_starts_with($line, '--') || str_starts_with($line, '/*')) {
                continue;
            }

            if (preg_match('/INSERT INTO `([^`]+)`/i', $line, $matches)) {
                $currentTable = $matches[1];
                // Map table names to Laravel convention
                $mappedTable = match($currentTable) {
                    'lga' => 'lgas',
                    'party' => 'parties',
                    'polling_unit' => 'polling_units',
                    'announced_pu_results' => 'announced_pu_results',
                    'ward' => 'wards',
                    default => null
                };

                if ($mappedTable) {
                    $insertBuffer = str_replace("INSERT INTO `$currentTable`", "INSERT INTO `$mappedTable`", $line);
                    // Handle multi-line inserts
                    if (!str_ends_with($insertBuffer, ';')) {
                        while (($nextLine = fgets($handle)) !== false) {
                            $nextLine = trim($nextLine);
                            $insertBuffer .= ' ' . $nextLine;
                            if (str_ends_with($nextLine, ';')) break;
                        }
                    }
                    
                    // Clean up 0000-00-00 dates for SQLite
                    $insertBuffer = str_replace("'0000-00-00 00:00:00'", "NULL", $insertBuffer);
                    
                    try {
                        \DB::unprepared($insertBuffer);
                    } catch (\Exception $e) {
                        $this->command->warn("Failed to insert into $mappedTable: " . $e->getMessage());
                    }
                }
            }
        }
        fclose($handle);
    }
}
