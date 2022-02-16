<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

interface SongRepositoryInterface
{
   /**
    * @param array $tags
    * @return array
    */
   public function idTwo($tags);
}
