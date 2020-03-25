<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class RepositoryService
{
    //Store a newly created with upload function
    public function createUpload(array $attributes, UploadedFile $fileUpload, $folder, $colum, $fileName = null)
    {
        $newName = '';
        $newName = !is_null($fileName) ? $fileName : $newName;
        $newName = $newName.time().'.'.$fileUpload->getClientOriginalExtension();
        
        $fileUpload->storeAs($folder, $newName);
        $attributes[$colum] = $newName;

        return $attributes;
    }

    //Update a newly created with upload function
    public function updateUpload(array $attributes, UploadedFile $fileUpload, $folder, $colum, $oldFile, $fileName)
    {
        try {
            if ($oldFile != 'default.png') {
                Storage::delete($folder.$oldFile);
            }
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        
        return $this->createUpload($attributes, $fileUpload, $folder, $colum, $fileName);
    }
}
