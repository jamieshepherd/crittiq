<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'     => 'Jamie Shepherd',
            'email'    => 'itsjamieshepherd@gmail.com',
            'password' => bcrypt('crittiq15'),
            'level'    => 10,
            'points'   => 1000
        ]);

        DB::table('users')->insert([
            'name'     => 'Paul Messenger',
            'email'    => 'paulbenjaminmessenger@gmail.com',
            'password' => bcrypt('crittiq15'),
            'level'    => 10,
            'points'   => 1000
        ]);

        DB::table('users')->insert([
            'name'     => 'Thomas Stembridge',
            'email'    => 'thomas.stembridge@gmail.com',
            'password' => bcrypt('crittiq15'),
            'level'    => 10,
            'points'   => 1000
        ]);
    }
}
