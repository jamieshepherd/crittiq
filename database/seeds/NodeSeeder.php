<?php

use Illuminate\Database\Seeder;

use App\Node;

class NodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inception
        $node = new Node();
        $node->category = 'films';
        $node->themoviedb_id = 27205;
        $node->imdb_id       = 'tt1375666';
        $node->title    = 'Inception';
        $node->slug     = 'inception';
        $node->director = "Christopher Nolan";
        $node->cover    = "50634dbcbe4617f17bb159d0.jpg";
        $node->year     = 2010;
        $node->synopsis = "A thief who steals corporate secrets through use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO.";
        $node->save();

        // 28 Days Later
        $node = new Node();
        $node->category = 'films';
        $node->themoviedb_id = 170;
        $node->imdb_id       = 'tt0289043';
        $node->title    = '28 Days Later...';
        $node->slug     = '28-days-later';
        $node->director = "Danny Boyle";
        $node->cover    = "50634dbcbe4617f17bb159d1.jpg";
        $node->year     = 2002;
        $node->synopsis = "Four weeks after a mysterious, incurable virus spreads throughout the UK, a handful of survivors try to find sanctuary.";
        $node->save();

        // Interstellar
        $node = new Node();
        $node->category = 'films';
        $node->themoviedb_id = 157336;
        $node->imdb_id       = 'tt0816692';
        $node->title    = 'Interstellar';
        $node->slug     = 'interstellar';
        $node->director = "Christopher Nolan";
        $node->cover    = "50634dbcbe4617f17bb159d2.jpg";
        $node->year     = 2014;
        $node->synopsis = "A team of explorers travel through a wormhole in space in an attempt to ensure humanity's survival.";
        $node->save();

        // Nosferatu
        $node = new Node();
        $node->category = 'films';
        $node->themoviedb_id = 653;
        $node->imdb_id       = 'tt0013442';
        $node->title    = 'Nosferatu';
        $node->slug     = 'nosferatu';
        $node->director = "F.W. Murnau";
        $node->year     = 1922;
        $node->synopsis = "Vampire Count Orlok expresses interest in a new residence and real estate agent Hutter's wife. Silent classic based on the story \"Dracula.\"";
        $node->save();
    }
}
