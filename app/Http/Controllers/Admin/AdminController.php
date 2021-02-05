<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Blog\Admin\Repositories\AdminRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function writeAdmin(AdminRepository $repository, Request $request)
    {
        $params = $request->all();

        return $repository->writeAdmin($params);
    }

    public function admins(AdminRepository $repository, Request $request)
    {
        $params = $request->all();

        return $repository->admins();
    }
}
