<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest;
use App\Services\EventsService;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * @var EventsService
     */
    public $service;

    /**
     * Create a new controller instance.
     *
     * @param EventsService $service
     */
    public function __construct(EventsService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = $this->service->all($request->all(), $request->query());
        return view('events')->with($data);
    }

    public function create(CreateEventRequest $request)
    {
        $data = $this->service->create($request->all());
        return view('events')->with($data);
    }
}
