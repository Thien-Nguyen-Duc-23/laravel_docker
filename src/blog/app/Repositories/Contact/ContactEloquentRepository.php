<?php
namespace App\Repositories\Contact;

use App\Repositories\EloquentRepository;
use App\Repositories\Contact\ContactRepositoryInterface;
use App\Models\Contact;

class ContactEloquentRepository extends EloquentRepository implements ContactRepositoryInterface
{
    public function getModel()
    {
        return Contact::class;
    }

    public function getContact($quantity)
    {
        return $this->model::where('status', config('define.disable'))
                            ->orderBy('created_at', 'desc')
                            ->take($quantity)
                            ->get();
    }
}
