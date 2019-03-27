<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        if ($this->canResetDatabase()) {
            Artisan::call('migrate:refresh', ['--quiet' => true]);
            $this->command->warn("Data cleared, starting from blank database.");
        }

        // Database data seeders
        $this->call(AclTableSeeder::class);
    }

    /**
     * Method to determine we can reset the database migrations or not.
     * 
     * @return bool
     */
    private function canResetDatabase(): bool 
    {
        return $this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')
            && app()->isLocal();
    }
}
