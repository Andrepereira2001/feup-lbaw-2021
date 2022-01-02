<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'resources/sql/init.sql';
        $populate = 'resources/sql/populate.sql';
        DB::unprepared(file_get_contents($path));
        DB::unprepared(file_get_contents($populate));
        $this->command->info('Database seeded!');
    }
}
