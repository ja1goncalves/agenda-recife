<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateTagsRequest;
use App\Services\TagsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    use CrudMethods {
        store as generalStore;
        edit as generalEdit;
    }

    /**
     * @var TagsService
     */
    protected $service;

    public function __construct(TagsService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('tags')->with($this->service->index());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(CreateCategoryRequest $request)
    {
        $this->service->create($request->all());
        return redirect('tags');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCategoryRequest $request
     * @return JsonResponse
     */
    public function store(CreateCategoryRequest $request)
    {
        return $this->generalStore($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UpdateTagsRequest $request
     * @return JsonResponse
     */
    public function edit(UpdateTagsRequest $request)
    {
        return $this->generalEdit($request, $request->get('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTagsRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateTagsRequest $request)
    {
        $this->service->update($request->all(), $request->get('id'));
        return  redirect('tags');
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
        return redirect('tags');
    }
}
