<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Support\Facades\Log;
use Prettus\Validator\Exceptions\ValidatorException;

class ProductController extends AbstractController
{
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function store(ProductRequest $request)
    {
        try {
            $data = $this->service->create($request);
            return response()->json([
                'data' => $data
            ]);
        } catch (ValidatorException | \Exception $e) {
            Log::error($e->getMessage());
            return $e;
        }
    }
}
