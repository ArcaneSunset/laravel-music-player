<?php

namespace App\Repositories\Eloquent;

use App\Models\Song;
use App\Repositories\SongRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class SongRepository extends BaseRepository implements SongRepositoryInterface
{
    public function __construct(Song $model)
    {
        parent::__construct($model);
    }

    public function idTwo($tags)
    {
        $array = [];
        $array['title'] = $tags['TIT2'];
        $array['year'] = $tags['TYER'];
        $array['publisher'] = $tags['TPUB'];
        $array['genre'] = $tags['TCON'];
        $array['album'] = $tags['TALB'];
        $array['artist'] = $tags['TPE2'];
        $array['track_number'] = $tags['TRCK'];
        $array['comment'] = $tags['TCOM'];
        $array['artist2'] = $tags['TPE1'];
        return $array;
    }
}