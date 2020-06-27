<?php


namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

abstract class AbstractController extends Controller
{

    protected $service;
    protected $model;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $data = $this->service->all();
            return response()->json([
                'data' => $data,
                'success' => true
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            Log::info("Erro no método listar da abstract controller");
            Log::error($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function show($id)
    {
        return $this->service->find($id);
    }

    /**
     * Store.
     *
     * @param $request
     * @return JsonResponse
     */
    public function save($request)
    {
        try {
          $data = $this->service->save($request);
          return response()->json([
              'data' => $data,
              'success' => true
          ], Response::HTTP_CREATED);
        } catch (Exception $exception) {
            Log::info("Erro no método criar da abstract controller");
            Log::error($exception->getMessage());
        }
    }

    /**
     * Store.
     *
     * @param $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function updateAs($request, $id)
    {
       return $this->service->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function delete($id)
    {
        return $this->service->delete($id);
    }
}
