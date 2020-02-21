<?php

use Illuminate\Database\Seeder;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            ['genre'=>'Action'],
            ['genre'=>'Sports'],
            ['genre'=>'Battle Royale'],
            ['genre'=>'Action-adventure'],
            ['genre'=>'Role play'],
            ['genre'=>'Adventure'],
            ['genre'=>'Racing'],
            ['genre'=>'Fighting'],
            ['genre'=>'Strategy'],
            ['genre'=>'Simulator'],
            ]);
    }
}
