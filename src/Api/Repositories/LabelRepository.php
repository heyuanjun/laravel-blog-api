<?php

/**
 * Created by PhpStorm.
 * User: HeYuanJun
 * Date: 2021/1/11
 * Time: 5:59 下午
 */

namespace Blog\Api\Repositories;

use Blog\Api\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class LabelRepository extends Repository
{
    public function labels()
    {
        return $this->getSearchAbleData(Article::class, ['title'],
            function (Builder $builder) {
            $builder->select([
                'id',
                'label',
            ]);
        });
    }

    public function getLabelInfo($params)
    {
        $label = Arr::get($params, 'label');
        $res = Article::where('label', $label)->get();

        return $res;
    }
}
