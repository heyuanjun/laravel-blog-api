<?php

namespace App\Http\Controllers;

use Blog\Api\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ArticleController extends BaseController
{
    public function articles(ArticleRepository $repository, Request $request)
    {
        $data = $request->all();

        return $repository->articles();
    }
}
