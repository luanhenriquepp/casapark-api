<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Services\StoreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class StoreController extends AbstractController
{

    public function __construct(StoreService $service)
    {
        $this->service = $service;
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $this->service->create($request);

            return response()->json([
                'data' => $data,
                'success' => true
            ], Response::HTTP_OK);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            throw new $exception;
        }
    }

    public function index()
    {
        return Redis::set('index', parent::index());
    }
}
