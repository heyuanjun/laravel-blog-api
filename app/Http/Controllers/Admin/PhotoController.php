<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Blog\Admin\Repositories\PhotoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function writePhoto(PhotoRepository $repository, Request $request)
    {
        $params = $request->all();

        return $repository->writePhoto($params);
    }

    public function uploadPhoto(Request $request)
    {
        $file = $request->file('file');

        if ($file) {
            //获取文件的原文件名 包括扩展名
            $oldName = $file->getClientOriginalName();
            //获取文件的扩展名
            $extension = $file->getClientOriginalExtension();
            //获取文件的类型
            $fileType = $file->getClientMimeType();
            //获取文件的绝对路径，但是获取到的在本地不能打开
            $path = $file->getRealPath();
            //要保存的文件名 时间+扩展名
            $filename = date('Y-m-d') . '/' . uniqid() . '.' . $extension;
            //保存文件          配置文件存放文件的名字  ，文件名，路径
            $bool = Storage::disk('uploads')
                ->put($filename, file_get_contents($path));
            //return back();
            return json_encode([
                'status' => 1,
                'filepath' => asset('storage/uploads/' . $filename),
            ]);
        } else {
            $idCardFrontImg = '';
            return json_encode($idCardFrontImg);
        }
    }

}
