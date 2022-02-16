<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Song;
use Illuminate\Support\Str;

class SongFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Song::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = Str::random(10);
        $artist = $this->faker->firstName. ' ' .$this->faker->lastName;
        $filename =  $artist.' '. $title;
        $filename =  Str::slug($filename, '-');
        return [
            'title' => $title,
            'artist' => $artist,
            'src' => '/storage/audio/'.$filename.'.mp3',
            'cover' =>  '/storage/img/mp3_fallback.png'
        ];
    }
}
