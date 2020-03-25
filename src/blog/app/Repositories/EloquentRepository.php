<?php

namespace App\Repositories;

use Illuminate\Http\UploadedFile;
use App\Services\RepositoryService;
use App\Repositories\InterfaceRepository;

abstract class EloquentRepository implements InterfaceRepository
{
    protected $model;
    protected $service;

    public function __construct(RepositoryService $service)
    {
        $this->setModel();
        $this->service = $service;
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        $result = $this->model->findOrFail($id);

        return $result;
    }

    public function update($id, array $attributes)
    {
        $result = $this->model->find($id);

        if ($result) {
            $result->update($attributes);
            
            return $result;
        }

        return false;
    }

    public function updateUpload($id, array $attributes, UploadedFile $fileUpload, $folder, $colum, $old, $fileName)
    {
        $attributes = $this->service->updateUpload($attributes, $fileUpload, $folder, $colum, $old, $fileName);

        $result = $this->model->find($id);

        if ($result) {
            $result->update($attributes);
            
            return $result;
        }

        return false;
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function createUpload(array $attributes, UploadedFile $fileUpload, $folder, $colum, $fileName = null)
    {
        $attributes = $this->service->createUpload($attributes, $fileUpload, $folder, $colum, $fileName);

        return $this->model->create($attributes);
    }

    public function delete($id)
    {
        $result = $this->find($id);

        if ($result) {
            $result->delete($id);

            return $result;
        }

        return false;
    }

    public function findSlug($slug)
    {
        $result = $this->model->where('slug', $slug)->get();

        return $result;
    }
}
