<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Blog\Api\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories(CategoryRepository $repository, Request $request)
    {
        $params = $request->all();

        return $repository->categories();
    }

    public function getManyCategories(CategoryRepository $repository, Request $request)
    {
        $params = $request->all();

        return $repository->getManyCategories($params);
    }
}
