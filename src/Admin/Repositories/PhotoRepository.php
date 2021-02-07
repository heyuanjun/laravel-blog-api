<?php

/**
 * Created by PhpStorm.
 * User: HeYuanJun
 * Date: 2021/1/11
 * Time: 5:59 下午
 */

namespace Blog\Admin\Repositories;

use Blog\Admin\Models\Talk;
use Illuminate\Support\Arr;
use Blog\Common\Repositories\Repository;

class PhotoRepository extends Repository
{
    public function writePhoto($params)
    {
        $id = Arr::get($params, 'id');

        return Talk::updateOrCreate(['id' => $id], $params);
    }

}
