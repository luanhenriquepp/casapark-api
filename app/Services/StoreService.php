<?php

namespace App\Services;

use App\Http\Requests\StoreRequest;
use App\Repositories\StoreRepository;
use Illuminate\Support\Facades\Log;

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

    public function create(StoreRequest $request)
    {

        $store = $this->repository->create($request->all());

        try {
            $store->save();
            if ($store) {
                $store->store_image = $this->createFile($request);
                $store->save();
            }
            return $store;
        }catch (Exception $e) {
            Log::info("Erro ao criar item da loja");
            Log::error($e->getMessage());
        }
    }

    public function createFile($file)
    {
        try {
            $fileName = uniqid().date('Y-m-d').'.'
                .mb_strtolower($file->store_image->getClientOriginalExtension());
            $directory = 'store/';
            $file->store_image->storeAs('public/'.$directory, $fileName);
            return $directory.$fileName;
        } catch (\Exception $exception) {
            Log::info("Erro ao montar path da imagem");
            Log::error($exception->getMessage());
        }

    }
}
