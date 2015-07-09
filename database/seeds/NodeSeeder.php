<?php

use Illuminate\Database\Seeder;

class NodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nodes')->insert([
            'category'  => 'films',
            'title'     => 'Inception',
            'series_id' => 1
        ]);

        DB::table('nodes')->insert([
            'category'  => 'films',
            'title'     => '28 Days Later',
            'series_id' => 1
        ]);

        DB::table('nodes')->insert([
            'category'  => 'films',
            'title'     => 'Interstellar',
            'series_id' => 1
        ]);
    }
}
