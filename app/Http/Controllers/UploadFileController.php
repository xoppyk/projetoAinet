<?php

namespace App\Http\Controllers;


use League\Flysystem\File;

use Illuminate\Support\Facades\Storage;

/**
 * Class what controll the Uploading File
 */
class UploadFileController extends Controller
{
    public static function store($path, $file)
    {
        return UploadFileController::splitPath(Storage::putFile($path, $file));
    }

    public static function splitPath($path)
    {
        $array = explode("/", $path);
        return end($array);
    }

    public static function isValid($file)
    {
        return $file->isValid();
    }
}
