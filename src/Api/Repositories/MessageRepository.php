<?php

/**
 * Created by PhpStorm.
 * User: HeYuanJun
 * Date: 2021/1/11
 * Time: 5:59 下午
 */

namespace Blog\Api\Repositories;

use Blog\Api\Models\AccessMessage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class MessageRepository extends Repository
{
    public function messages()
    {
        return $this->getSearchAbleData(AccessMessage::class, ['title'],
            function (Builder $builder) {
        });
    }
}
