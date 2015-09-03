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
        $node->poster    = "50634dbcbe4617f17bb159d0.jpg";
        $node->year     = 2010;
        $node->synopsis = "A thief who steals corporate secrets through use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO.";
        $node->save();
    }
}
