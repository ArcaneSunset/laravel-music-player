<?php

namespace App\Repositories\Eloquent;

use App\Models\Song;
use App\Repositories\SongRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class SongRepository extends BaseRepository implements SongRepositoryInterface
{
    protected $tags2 = [
        "title" => "TIT2",
        "year" => "TYER",
        "publisher" => "TPUB",
        "genre" => "TCON",
        "album" => "TALB",
        "artist" => "TPE1",
        "track_number" => "TRCK",
        "comment" => "TCOM",
        "band" => "TPE2",
        "length" => "TLEN",
        "encoder_settings" => "TSSE"
    ];

    public function __construct(Song $model)
    {
        parent::__construct($model);
    }

    public function idTwo($tags)
    {
        $array = [];
        foreach($this->tags2 as $key => $value)
        {
            if(array_key_exists($value, $tags))
            $array[$key] = $tags[$value];
        }
        return $array;
    }
}