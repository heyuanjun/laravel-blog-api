<?php

namespace App\Http\Controllers;

use Blog\Api\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CategoryController extends BaseController
{
    public function categories(CategoryRepository $repository, Request $request)
    {
        $data = $request->all();

        return $repository->categories();
    }
}
