<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = ['name'=> 'Patrick', 'email'=> 'admin@domain.com'];

        factory('App\User')->create($user);

        $this->command->warn("Admin credentials: email: {$user['email']} | pass: password");
    }
}
