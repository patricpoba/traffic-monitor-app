<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    protected $tables = [
        'http_requests',
        'users'
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables();
        
        $this->call(UsersTableSeeder::class);
        $this->call(HttpRequestSeeder::class);
    }


    protected function truncateTables()
    {
        Schema::disableForeignKeyConstraints();

        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }

        Schema::enableForeignKeyConstraints();
    }
}
