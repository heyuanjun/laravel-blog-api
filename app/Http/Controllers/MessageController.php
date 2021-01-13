<?php

namespace App\Http\Controllers;

use Blog\Api\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class MessageController extends BaseController
{
    public function messages(MessageRepository $repository, Request $request)
    {
        $params = $request->all();

        return $repository->messages();
    }
}
