<?php

namespace App\Http\Controllers;

use Blog\Api\Repositories\LabelRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class LabelController extends BaseController
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
