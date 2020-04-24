<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 10:40
 */

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;;
use App\Services\AppService;
use Illuminate\Support\Facades\Validator;

/**
 * Class CrudMethods
 * @package app\Http\Controllers\Traits
 */
trait CrudMethods
{
    /** @var  AppService $service */
    protected $service;

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorId(array $data)
    {
        return Validator::make($data, ['id' => ['required', 'string', 'max:10']]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function all(Request $request)
    {
        return response()->json($this->service->all($request->all()));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function edit(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param $id
     * @return array
     */
    public function restore($id)
    {
        return $this->service->restore($id);
    }

    /**
     * Softdeletes the specified resource from storage.
     *
     * @param Request $request
     * @return array
     */
    public function delete(Request $request)
    {
        $this->validatorId($request->all())->validate();
        return $this->service->delete($request->get('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->service->forceDelete($id);
    }
}
