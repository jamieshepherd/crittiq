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
            'slug'      => 'inception',
            'director'  => "Christopher Nolan",
            'year'      => 2010,
            'synopsis'  => "A thief who steals corporate secrets through use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO."
        ]);

        DB::table('nodes')->insert([
            'category'  => 'films',
            'title'     => '28 Days Later',
            'slug'      => '28_days_later',
            'director'  => "Danny Boyle",
            'year'      => 2002,
            'synopsis'  => "Four weeks after a mysterious, incurable virus spreads throughout the UK, a handful of survivors try to find sanctuary."
        ]);

        DB::table('nodes')->insert([
            'category'  => 'films',
            'title'     => 'Interstellar',
            'slug'      => 'interstellar',
            'director'  => "Christopher Nolan",
            'year'      => 2014,
            'synopsis'  => "A team of explorers travel through a wormhole in space in an attempt to ensure humanity's survival."
        ]);
    }
}
