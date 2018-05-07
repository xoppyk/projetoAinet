<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class DeleteFileController extends Controller
{
    public static function deleteFile($path)
    {
        return Storage::delete($path);
    }
}
