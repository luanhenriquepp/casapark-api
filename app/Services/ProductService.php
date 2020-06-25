<?php

namespace App\Services;

use App\Http\Requests\StoreRequest;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Prettus\Validator\Exceptions\ValidatorException;

class ProductService extends AbstractService
{

    protected $repository;
    protected $validator;

    /**
     * PurchaseService constructor.
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param StoreRequest $request
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function create(StoreRequest $request)
    {
        try {
            $path = Storage::disk('s3')
                ->put('store', $request->file);
            $request->merge([
                'path' => $path
            ]);
            $data = $request->except('file');

            return $this->repository
                ->create($data);
        } catch (ValidatorException $e) {
            Log::info("Erro na service criar produto");
            Log::error($e->getMessage());
        }
    }
}
