<?php
namespace App\Repositories\InformationAccount;

use App\Repositories\EloquentRepository;
use App\Models\UserInformation;

class InformationAccountEloquentRepository extends EloquentRepository implements InformationAccountInterfaceRepository
{
    // // inject UserInformation in getModel
    public function getModel()
    {
        return UserInformation::class;
    }
}
