<?php

/**
 * Created by PhpStorm.
 * User: HeYuanJun
 * Date: 2021/1/11
 * Time: 5:59 下午
 */

namespace Blog\Admin\Repositories;

use Blog\Admin\Models\Admin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Blog\Common\Repositories\Repository;

class AdminRepository extends Repository
{
    public function writeAdmin($params)
    {
        $id = Arr::get($params, 'id');

       return Admin::updateOrCreate(['id' => $id], $params);
    }

    public function admins()
    {
        return $this->getSearchAbleData(Admin::class, ['username'],
            function (Builder $builder) {
        });
    }

}
