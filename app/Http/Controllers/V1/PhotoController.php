<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Blog\Api\Repositories\PhotoRepository;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function photos(PhotoRepository $repository, Request $request)
    {
        $params = $request->all();

        return $repository->photos();
    }
}
