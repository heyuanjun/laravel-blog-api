<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Blog\Api\Repositories\ArticleRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
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
