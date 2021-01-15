<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Blog\Api\Repositories\MusicRepository;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function music(MusicRepository $repository, $id)
    {
        return $repository->music($id);
    }
}
