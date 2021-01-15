<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function testA()
    {
        return json_encode([
            1,
            2,
            3,
        ]);
    }
}
