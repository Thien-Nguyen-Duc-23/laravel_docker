<?php
namespace App\Repositories\Rates;

use App\Repositories\EloquentRepository;
use App\Models\Rate;

class RateEloquentRepository extends EloquentRepository implements RateRepositoryInterface
{
    public function getModel()
    {
        return Rate::class;
    }
}
