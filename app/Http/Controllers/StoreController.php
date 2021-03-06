<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Services\StoreService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Prettus\Repository\Exceptions\RepositoryException;

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

    public function update($request, $id)
    {
        return parent::updateAs($request, $id);
    }

    public function getAllStoreArray()
    {
        return  response()->json([
            'data' => $this->service->getAllStoreArray()
        ], Response::HTTP_OK);
    }

    public function index()
    {
        return response()->json([
            'data' => $this->service->getAllStore(),
            'message' => 'Lista'
        ], Response::HTTP_OK);
    }
    /**
     * @return JsonResponse
     * @throws RepositoryException
     */
    public function getAllStore()
    {
        return response()->json([
            'data' => $this->service->getAllStorePublic(),
            'message' => 'Lista'
        ], Response::HTTP_OK);
    }
    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
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
        return $this->service->delete($id);
    }
}
