<?php

namespace App\Http\Controllers;

use Blog\Api\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ArticleController extends BaseController
{
    public function articles(ArticleRepository $repository, Request $request)
    {
        $params = $request->all();

        return $repository->articles();
    }

    public function recentArticles(ArticleRepository $repository, Request $request)
    {
        $params = $request->all();

        return $repository->recentArticles();
    }

    public function getArticleById(ArticleRepository $repository, $id)
    {
        return $repository->getArticleById($id);
    }

}
