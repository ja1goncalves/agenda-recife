<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Jobs\VerificationRoutes;
use App\Services\PermissionsService;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    use CrudMethods {
        store as generalStore;
        edit as generalEdit;
    }

    /**
     * @var PermissionsService
     */
    protected $service;

    public function __construct(PermissionsService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = $this->service->index($request->all());
        return view('permissions')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function inactiveRoute(Request $request)
    {
        $this->service->inactiveRoute($request->query('id'));
        return redirect('permissoes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateRoutes(Request $request)
    {
        VerificationRoutes::dispatch();
        return redirect('permissoes');
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshRoutes(Request $request)
    {
        VerificationRoutes::dispatch();
        return response()->json($this->service->all($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        $this->service->delete($request->get('id'));
        return redirect('permissoes');
    }
}
