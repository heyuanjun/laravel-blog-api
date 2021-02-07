<?php

/**
 * Created by PhpStorm.
 * User: HeYuanJun
 * Date: 2021/1/11
 * Time: 5:59 下午
 */

namespace Blog\Api\Repositories;

use Blog\Admin\Models\Talk;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Blog\Common\Repositories\Repository;

class PhotoRepository extends Repository
{
    public function photos()
    {
        return $this->getSearchAbleData(Talk::class, ['content'],
            function (Builder $builder) {
        });
    }

}
