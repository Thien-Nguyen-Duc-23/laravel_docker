<?php

namespace App\Repositories;

use Illuminate\Http\UploadedFile;

interface InterfaceRepository
{
    public function getAll();

    public function find($id);

    public function create(array $attributes);

    public function createUpload(array $attributes, UploadedFile $fileUpload, $folder, $colum, $fileName);

    public function update($id, array $attributes);
    
    public function updateUpload($id, array $attributes, UploadedFile $fileUpload, $folder, $colum, $old, $fileName);

    public function delete($id);

    public function findSlug($slug);
}
