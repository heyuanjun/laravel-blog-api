<?php

namespace App\Http\Controllers;

use Blog\Api\Repositories\MusicRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class MusicController extends BaseController
{
    public function music(MusicRepository $repository, $id)
    {
        return $repository->music($id);
    }
}
