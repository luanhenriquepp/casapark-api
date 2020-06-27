<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Services\StoreService;
use Exception;
use Illuminate\Http\JsonResponse;

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

    /**
     * @param $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        return parent::delete($id);
    }
}
