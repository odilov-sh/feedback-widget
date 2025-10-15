<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    public function create(array $data): Customer
    {
        return Customer::create($data);
    }

    public function findOrCreate(array $attributes = [], array $values = []): Customer
    {
        return Customer::firstOrCreate($attributes, $values);
    }
}
