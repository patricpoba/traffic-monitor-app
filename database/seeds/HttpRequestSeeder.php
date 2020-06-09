<?php

use Illuminate\Database\Seeder;

class HttpRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\HttpRequest::class, 60)->create();
    }
}
