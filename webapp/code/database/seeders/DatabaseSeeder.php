<?php


namespace Database\Seeders;

use Eloquent;
use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        DB::unprepared(file_get_contents('resources/sql/db_create_schema.sql'));
        $this->command->info('DB: Schema created');

        DB::unprepared(file_get_contents('resources/sql/db_create.sql'));
        $this->command->info('DB: Database created');

        DB::unprepared(file_get_contents('resources/sql/db_performance_indexes.sql'));
        $this->command->info('DB: Performance indexes created');

        DB::unprepared(file_get_contents('resources/sql/db_triggers.sql'));
        $this->command->info('DB: Triggers created');

        $this->command->info('DB: Database seeded!');
    }
}
