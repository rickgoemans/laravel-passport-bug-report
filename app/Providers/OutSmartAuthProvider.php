<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Hashing\Hasher;

class OutSmartAuthProvider extends EloquentUserProvider
{
    public function __construct($model)
    {
        parent::__construct(app(Hasher::class), $model);
    }

    // NOTE: Left out all the customer "retrieveBy..." and "validateCredentials" functions for the purpose of this bug-report
}
