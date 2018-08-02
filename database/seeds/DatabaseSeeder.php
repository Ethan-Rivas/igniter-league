<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tournaments')->insert([
            'name' => "Test Tournament",
            'description' => "This is just an UNREGISTERED tournament ONLY for database testing",
        ]);
    }
}
