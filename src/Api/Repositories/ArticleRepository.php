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

class ArticleRepository extends Repository
{
    public function articles()
    {
        return $this->getSearchAbleData(Article::class, ['title'],
            function (Builder $builder) {
        });
    }

    public function recentArticles()
    {
        return $this->getSearchAbleData(Article::class, ['title'],
            function (Builder $builder) {
                $builder->select([
                    'title',
                    'label',
                    'article_id',
                    'time',
                ]);
                $builder->orderBy('id');
                $builder->limit(10);
            });
    }

}
