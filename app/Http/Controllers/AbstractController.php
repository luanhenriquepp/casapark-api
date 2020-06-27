<?php


namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;

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
        return $this->service->all();
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
        return $this->service->save($request);
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
