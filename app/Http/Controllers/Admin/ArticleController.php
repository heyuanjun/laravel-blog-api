<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Blog\Admin\Repositories\ArticleRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function writeArticle(ArticleRepository $repository, Request $request)
    {
        $params = $request->all();

        return $repository->writeArticle($params);
    }

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

    public function deleteArticleById(ArticleRepository $repository, $id)
    {
        return $repository->deleteArticleById($id);
    }

}
