<?php

namespace App\Services;

use App\Repositories\StoreRepository;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
     * @param int|string $id
     * @return null
     * @throws Exception
     */
    public function delete($id)
    {
        $this->deleteDirectoryFromS3($id);
        return parent::delete($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteDirectoryFromS3($id)
    {
        $store = $this->repository->find($id);
        $newstring = Str::of($store->store_name)->replace(' ', '-')->lower();
        return Storage::disk('s3')->deleteDirectory($newstring);
    }
}
