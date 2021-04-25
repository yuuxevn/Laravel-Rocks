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
        \App\User::create([
            'name' => 'Krido Pambudi',
            'username' => 'kridospace',
            'password' => bcrypt('password'),
            'email' => 'kridospace@gmail.com'
        ]);
    }
}
