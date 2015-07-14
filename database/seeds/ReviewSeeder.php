<?php

use Illuminate\Database\Seeder;

use App\Node;
use App\User;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = User::where('name', '=', 'Jamie Shepherd')->first();
        $film = Node::where('category', '=', 'films')->where('title', '=', 'Inception')->first();

        DB::table('reviews')->insert([
            'author'    => $author->_id,
            'node'      => $film->_id,
            'score'     => 7.9,
            'review'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
        ]);

        DB::table('reviews')->insert([
            'author'    => $author->_id,
            'node'      => $film->_id,
            'score'     => 8.9,
            'review'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
        ]);

        DB::table('reviews')->insert([
            'author'    => $author->_id,
            'node'      => $film->_id,
            'score'     => 5.9,
            'review'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
        ]);
    }
}
