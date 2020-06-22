<?php

namespace App\Services;

use App\Repositories\StoreRepository;

class StoreService extends AbstractService
{

    protected $repository;
    protected $validator;

    /**
     * PurchaseService constructor.
     * @param StoreRepository $repository
     */
    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }
}
