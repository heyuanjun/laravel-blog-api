<?php

/**
 * Created by PhpStorm.
 * User: HeYuanJun
 * Date: 2021/1/11
 * Time: 5:59 下午
 */

namespace Blog\Admin\Repositories;

use Blog\Api\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Blog\Common\Repositories\Repository;

class ArticleRepository extends Repository
{
    public function writeArticle($params)
    {
        $id = Arr::get($params, 'id');

       return Article::updateOrCreate(['id' => $id], $params);
    }

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

    public function getArticleById($id)
    {
        $builder = Article::query();
        $builder->where('id', $id);
        $res = $builder->first();

      /* 更新后台浏览数量数据start */
        $res->visited += 1;
        $res->save();
      /* 更新浏览数据end */

        return $res;
    }

    public function deleteArticleById($id)
    {
        return Article::destroy($id);
    }

}
