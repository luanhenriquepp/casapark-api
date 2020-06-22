<?php

namespace App\Services;

use App\Http\Requests\StoreRequest;
use App\Repositories\ProductRepository;
use App\Repositories\StoreRepository;
use Illuminate\Http\JsonResponse;
use Prettus\Validator\Exceptions\ValidatorException;

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
     * @throws ValidatorException
     */
    public function create(StoreRequest $request)
    {
        try {
            $image = $this->handleImage($request->file('store_image')->path());
            $data = $request->all();
            $data['store_image'] = $image;
            return $this->repository->create($data);
        }catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * @param $file
     * @return JsonResponse|string
     */
    public function handleImage($file)
    {
        if (!$file)
            return response()->json(['error' => 'Por favor selecione uma imagem!']);
        return base64_encode(file_get_contents($file));
    }
}
