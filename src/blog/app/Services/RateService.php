<?php

namespace App\Services;

use App\Repositories\Rates\RateRepositoryInterface;
use App\Http\Requests\Client\RateRequest;

class RateService
{
    protected $rate;

    public function __construct(RateRepositoryInterface $rate)
    {
        $this->rate = $rate;
    }

    public function rating(RateRequest $request)
    {
        $attributes = [
            'star' => $request->rating,
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
        ];

        return $this->rate->create($attributes);
    }
}
