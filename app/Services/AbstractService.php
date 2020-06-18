<?php


namespace App\Services;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;

abstract class AbstractService
{
    /**
     * @var BaseRepository
     */
    protected $repository;

    /**
     * AbstractService constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->service = $model;
    }

    /**
     * Returns a paginated list of Model.
     *
     * @return mixed
     * @throws RepositoryException
     */
    public function all()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $data = $this->repository->with($this->repository->relationships)->paginate(20);

        return response()->json([
            'data' => $data,
            'message' => 'Lista'
        ], Response::HTTP_OK);
    }

    /**
     * Data of a Model by primary key
     *
     * @param int|string $id
     *
     * @return mixed
     * @throws Exception
     */
    public function find($id)
    {
        $data = $this->repository->with($this->repository->relationships)->find($id);
        return response()->json([
            'data' => $data,
            'message' => 'Detalhe'
        ],Response::HTTP_OK);
    }

    /**
     * Store a newly created Model in storage.
     *
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function save(Request $request)
    {
        $data = $this->repository->create($request->all());
        return response()->json([
            'data' => $data,
            'message' => 'Criado com sucesso!'
        ],Response::HTTP_OK);
    }

    /**
     * Update the specified Model in storage.
     *
     * @param Request $request
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function update(Request $request, $id)
    {
        $data = $this->repository->update($request->all(), $id);

        return response()->json([
            'data' => $data,
            'message' => 'Atualizado com sucesso!'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified Model from storage.
     *
     * @param int|string $id
     *
     * @return null
     * @throws Exception
     */
    public function delete($id)
    {
        $data = $this->repository->delete($id);
        return response()->json([
            'success' => $data,
            'message' => 'Deletado com sucesso!'
        ],Response::HTTP_OK);
    }
}
