<?php
namespace App\Repositories\SocialAccount;

use App\Repositories\EloquentRepository;
use App\Models\SocialAccount;

class SocialAccountEloquentRepository extends EloquentRepository implements SocialAccountInterfaceRepository
{
    // inject SocialAccount in getModel
    public function getModel()
    {
        return SocialAccount::class;
    }
}
