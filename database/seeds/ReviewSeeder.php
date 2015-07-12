<?php

use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            'author'    => 'TEST',
            'film'      => 'TEST',
            'score'     => 8.9,
            'review'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
            'timestamp' => 'TEST'
        ]);

        DB::table('reviews')->insert([
            'author'    => 'TEST',
            'film'      => 'TEST',
            'score'     => 8.9,
            'review'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
            'timestamp' => 'TEST'
        ]);

        DB::table('reviews')->insert([
            'author'    => 'TEST',
            'film'      => 'TEST',
            'score'     => 8.9,
            'review'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
            'timestamp' => 'TEST'
        ]);

         DB::table('reviews')->insert([
            'author'    => 'TEST',
            'film'      => 'TEST',
            'score'     => 8.9,
            'review'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
            'timestamp' => 'TEST'
        ]);

          DB::table('reviews')->insert([
            'author'    => 'TEST',
            'film'      => 'TEST',
            'score'     => 8.9,
            'review'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ',
            'timestamp' => 'TEST'
        ]);
    }
}
