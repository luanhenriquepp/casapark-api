<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
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


    public function publicPage()
    {
        return parent::index();
    }

    /**
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store(ProductRequest $request)
    {
        try {
            $data = $this->service->create($request);

            return response()->json([
                'data' => $data,
                'success' => true
            ], Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            Log::info("Erro na controller criar produto");
            Log::error($exception->getMessage());
        }
    }
}
