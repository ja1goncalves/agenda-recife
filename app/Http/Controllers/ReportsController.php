<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Http\Requests\CreateReportRequest;
use App\Services\ReportsService;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    use CrudMethods {
        store as generalStore;
        edit as generalEdit;
    }

    /**
     * @var ReportsService
     */
    protected $service;

    public function __construct(ReportsService $service)
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
        return view('reports')->with($this->service->index($request->all()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateReportRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(CreateReportRequest $request)
    {
        $reports = $this->service->create($request->all());
        return redirect('contatos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateReportRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateReportRequest $request)
    {
        return $this->generalStore($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
