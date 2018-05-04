<?php

namespace App\Http\Controllers;



use Illuminate\Http\File;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class UploadFileController extends Controller
{
    public static function store($path, $file)
    {
        return Storage::putFile($path, $file);
    }

    public static function splitPath($path)
    {
        $array = explode("/", $path);
        return $array[2];
    }

    public static function fileValidate(File $file)
    {
        return $file->isValid();
    }
}
