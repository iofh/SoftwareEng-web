<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([

=======
            ['title'=>'Minecraft','body'=>'Minecraft is a sandbox independent video game originally created by Swedish programmer Markus "Notch" Persson and later developed and published by the Swedish company Mojang', 'genre_id'=>'1'],
            ['title'=>'Grand Theft Auto','body'=>'Grand Theft Auto V is an open world, action-adventure video game developed by Rockstar North and published by Rockstar Games','genre_id'=>'2'],
            ['title'=>'Fortnite','body'=>'Fortnite is a co-op sandbox survival game developed by Epic Games and People Can Fly, the former also publishing the game', 'genre_id'=>'3'],
            ['title'=>'Rainbow Six Siege','body'=>'Tom Clancys Rainbow Six Siege is a tactical shooter video game developed by Ubisoft Montreal and published by Ubisoft', 'genre_id'=>'4'],
            ['title'=>'Roblox','body'=>'Roblox, stylized as RŌBLOX, is a massively multiplayer online game created and marketed toward children and teenagers aged 8–18.', 'genre_id'=>'5'],
            ['title'=>'Red Dead Redemption','body'=>'Red Dead Redemption 2 (stylized as Red Dead Redemption II) is a Western-themed action-adventure video game developed and published by Rockstar Games', 'genre_id'=>'6'],
            ['title'=>'Overwatch','body'=>'Overwatch is a team-based multiplayer online first-person shooter video game developed and published by Blizzard Entertainment', 'genre_id'=>'1'],
            ['title'=>'CS:GO','body'=>'Counter-Strike: Global Offensive is an online tactical first-person shooter developed by Valve Corporation and Hidden Path Entertainment, who also maintained Counter-Strike: Source after its release', 'genre_id'=>'2'],
            ['title'=>'Call of Duty Black Ops 4','body'=>'Call of Duty: Black Ops 4 (stylized as Call of Duty: Black Ops IIII) is a multiplayer first-person shooter developed by Treyarch and published by Activision', 'genre_id'=>'3'],
            ['title'=>'Spider-Man','body'=>'Spider-Man is an action-adventure game based on the Marvel Comics superhero Spider-Man, developed by Insomniac Games and published by Sony Interactive Entertainment for PlayStation 4', 'genre_id'=>'4']

        ]);
    }

}
