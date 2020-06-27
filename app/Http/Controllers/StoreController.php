<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Services\StoreService;

class StoreController extends AbstractController
{

    /**
     * StoreController constructor.
     * @param StoreService $service
     */
    public function __construct(StoreService $service)
    {
        $this->service = $service;
    }

    public function store(StoreRequest $request)
    {
        return parent::save($request);
    }
}
