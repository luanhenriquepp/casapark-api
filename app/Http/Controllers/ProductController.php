<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ProductController extends AbstractController
{
    public function __construct(ProductService $service)
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
            Log::info("Erro na controller criar produto");
            Log::error($exception->getMessage());
        }
    }
}
