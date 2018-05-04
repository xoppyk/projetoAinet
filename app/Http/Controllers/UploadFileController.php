<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

/**
 * Class what controll the Uploading File
 */
class UploadFileController extends Controller
{
    public static function store($path, $file)
    {
        return Storage::putFile($path, $file);
    }

    public static function splitPath($path)
    {
        $array = explode("/", $path);
        return end($array);
    }

    public static function fileValidate(File $file)
    {
        return $file->isValid();
    }
}
