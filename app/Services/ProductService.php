<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;
use App\Repositories\StoreRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Prettus\Validator\Exceptions\ValidatorException;

class ProductService extends AbstractService
{

    protected $repository;
    protected $validator;
    protected $storeRepository;

    /**
     * PurchaseService constructor.
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository, StoreRepository $storeRepository)
    {
        $this->repository = $repository;
        $this->storeRepository = $storeRepository;
    }

    /**
     * @param ProductRequest $request
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function create(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $store = $this->storeRepository->find($request->store_id);
            $newstring = Str::of($store->store_name)->replace(' ', '-')->lower();
            $path = Storage::disk('s3')
                ->put($newstring, $request->file);
            $request->merge([
                'path' => $path
            ]);
            $data = $request->except('file');

            $product = $this->repository
                ->create($data);

            DB::commit();
            return $product;
        } catch (ValidatorException | \Exception $e) {
            Log::info("Erro na service criar produto");
            Log::error($e->getMessage());
            DB::rollBack();
        }
    }

    /**
     * @param $id
     * @return null
     */
    public function removeProduct($id)
    {
        try {
            $store = $this->repository->find($id);
            $this->removeImageFromS3($store->path);
            return parent::delete($id);
        } catch (\Exception $e) {
            Log::info("Erro ao tentar apagar produto");
            Log::error($e->getMessage());
        }
    }

    /**
     * @param $image
     * @return bool
     */
    public function removeImageFromS3($image)
    {
        return Storage::disk('s3')->delete($image);
    }
}
