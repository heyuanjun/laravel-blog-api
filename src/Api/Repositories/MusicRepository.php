<?php

/**
 * Created by PhpStorm.
 * User: HeYuanJun
 * Date: 2021/1/11
 * Time: 5:59 下午
 */

namespace Blog\Api\Repositories;

use Blog\Api\Models\Music;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class MusicRepository extends Repository
{
    public function music($id)
    {
        return Music::findOrFail($id);
    }
}
