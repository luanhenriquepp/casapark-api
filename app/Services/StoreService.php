<?php

namespace App\Services;

use App\Repositories\StoreRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Prettus\Repository\Exceptions\RepositoryException;

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
     * @return JsonResponse
     * @throws RepositoryException
     */
    public function getAllStore()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        return $this->repository->with($this->repository->relationships)
            ->orderBy('store_name', 'asc')
            ->paginate(20);
    }

    /**
     * @return LengthAwarePaginator|Collection|mixed
     * @throws RepositoryException
     */
    public function getAllStorePublic()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        return $this->repository->with($this->repository->relationships)->paginate(50);
    }



    /**
     * @return LengthAwarePaginator|Collection|mixed
     * @throws RepositoryException
     */
    public function getAllStoreArray()
    {
        return $this->repository->all();

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
