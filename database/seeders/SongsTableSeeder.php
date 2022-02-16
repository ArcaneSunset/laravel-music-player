<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Song;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $songs = array([
                'title' =>  'Farewell',
                'artist' =>  'Mountaineer',
                'src' =>  '/storage/audio/farewell-mountaineer.mp3',
                'cover' =>  '/storage/img/mp3_fallback.png'
            ],
            [
                'title' =>  'Good Intention',
                'artist' =>  'Soundroll',
                'src' =>  '/storage/audio/good-intention-soundroll.mp3',
                'cover' =>  '/storage/img/mp3_fallback.png'
            ],
            [
                'title' =>  'Soul',
                'artist' =>  'Fugu Vibes',
                'src' =>  '/storage/audio/soul-fugu-vibes.mp3',
                'cover' =>  '/storage/img/mp3_fallback.png'
            ],
            [
                'title' =>  'Permafrost',
                'artist' =>  'Bakerman',
                'src' =>  '/storage/audio/permafrost-bakerman.mp3',
                'cover' =>  '/storage/img/mp3_fallback.png'
            ]
        );

        Song::insert($songs);
    }
}
