<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Http\Requests\CreatePublicityRequest;
use App\Http\Requests\UpdatePublicityRequest;
use App\Services\AdsService;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    use CrudMethods {
        store as generalStore;
        edit as generalEdit;
    }

    /**
     * @var AdsService
     */
    protected $service;

    public function __construct(AdsService $service)
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
        return view('ads')->with($this->service->index($request->all()));
    }

    public function create(CreatePublicityRequest $request)
    {
        $this->service->create($request->all());
        return redirect('publicidades');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePublicityRequest $request)
    {
        return $this->generalStore($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UpdatePublicityRequest $request
     * @return void
     */
    public function edit(UpdatePublicityRequest $request)
    {
        return $this->generalEdit($request, $request->get('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePublicityRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdatePublicityRequest $request)
    {
        $this->service->update($request->all(), $request->get('id'));
        return  redirect('publicidades');
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
        return redirect('publicidades');
    }
}
