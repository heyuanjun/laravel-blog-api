<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Blog\Api\Repositories\MessageRepository;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function messages(MessageRepository $repository, Request $request)
    {
        $params = $request->all();

        return $repository->messages();
    }

    public function leaveMessage(MessageRepository $repository, Request $request)
    {
        $params = $request->all();

        return $repository->leaveMessage($params);
    }

}
