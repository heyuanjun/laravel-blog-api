<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Blog\Api\Repositories\LabelRepository;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function labels(LabelRepository $repository, Request $request)
    {
        $params = $request->all();

        return $repository->labels();
    }

    public function getLabelInfo(LabelRepository $repository, Request $request)
    {
        $params = $request->all();

        return $repository->getLabelInfo($params);
    }
}
