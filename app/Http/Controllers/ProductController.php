<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Exception;
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
     * @return JsonResponse
     */
    public function publicPage()
    {
        return response()->json([
            'data' => $this->service->getAllPublicPage(),
            'message' => 'Lista'
        ], Response::HTTP_OK);
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
        } catch (Exception $exception) {
            Log::info("Erro na controller criar produto");
            Log::error($exception->getMessage());
        }
    }

    /**
     * @param ProductRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            $data = $this->service->updateProduct($request, $id);
            return response()->json([
                'data' => $data,
                'success' => true
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            Log::info("Erro na controller atualizar produto");
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        return $this->service->removeProduct($id);
    }
}
