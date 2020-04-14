<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Services\EventsService;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    use CrudMethods {
        store as generalStore;
        edit as generalEdit;
    }
    /**
     * @var EventsService
     */
    protected $service;

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
        $data = $this->service->index($request->all());
        return view('events')->with($data);
    }

    public function create(CreateEventRequest $request)
    {
        $response = $this->service->create($request->all());
        return redirect('editar-evento?id='. $response['data']['id']);
    }

    public function store(CreateEventRequest $eventRequest)
    {
        return $this->generalStore($eventRequest);
    }

    public function edit(Request $request)
    {
        $id = $request->get('id');
        if ($id == '*')
            return view('event-add')->with(['categories' => $this->service->categories(), 'tags' => $this->service->tags()]);
        else
            return view('event-view')->with($this->service->find($request->get('id')));
    }

    public function save(UpdateEventRequest $request)
    {
        return $this->generalEdit($request, $request->get('id'));
    }

    public function update(UpdateEventRequest $request)
    {
        $event = $this->service->update($request->all(), $request->get('id'));
        return redirect('editar-evento?id='. $event['data']['id']);
    }

    public function destroy(Request $request)
    {
        $this->service->delete($request->get('id'));
        return redirect('eventos');
    }
}
