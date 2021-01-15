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
use Illuminate\Support\Facades\DB;
use Blog\Common\Repositories\Repository;

class CategoryRepository extends Repository
{
    public function categories()
    {
        return $this->getSearchAbleData(Article::class, ['title'],
            function (Builder $builder) {
            $builder->select([
                'article_category',
                DB::raw("COUNT(article_category)")
            ]);
            $builder->groupBy('article_category');
        });
    }

    public function getManyCategories($params)
    {
        $category = Arr::get($params, 'category');

        $res = Article::where('article_category', $category)->get();
        return $res;
    }
}
