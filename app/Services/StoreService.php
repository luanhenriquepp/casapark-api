<?php

namespace App\Services;

use App\Http\Requests\StoreRequest;
use App\Repositories\ProductRepository;
use App\Repositories\StoreRepository;

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

    /**
     * @param  $request
     * @return JsonResponse $advertisement
     */
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
            Log::error($e->getMessage());
        }
    }

    public function createFile($file)
    {

        $fileName = uniqid().date('Y-m-d').'.'.mb_strtolower($file->store_image->getClientOriginalExtension());
        $directory = 'store/';
        $file->store_image->storeAs('public/'.$directory, $fileName);
        return $directory.$fileName;
    }
}
