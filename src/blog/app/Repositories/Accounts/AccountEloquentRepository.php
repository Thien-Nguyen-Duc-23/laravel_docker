<?php
namespace App\Repositories\Accounts;

use App\Repositories\EloquentRepository;
use App\Models\Account;
use App\Models\UserInformation;

class AccountEloquentRepository extends EloquentRepository implements AccountInterfaceRepository
{
    // inject Account in getModel
    public function getModel()
    {
        return Account::class;
    }
}
