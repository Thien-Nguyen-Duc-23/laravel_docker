<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class AdminHelper
{
    public static function deleteFile($folder, $oldFile)
    {
        try {
            if ($oldFile != 'default.png') {
                Storage::delete($folder.$oldFile);
            }
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }
}
