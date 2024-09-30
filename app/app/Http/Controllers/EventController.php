<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    private EventService $eventService;

    public function __construct(EventService $eventService){
        $this->eventService = $eventService;
    }

    /**
     * List all events
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $events = $this->eventService->getEvents();

        return response()->json([
            'events' => $events,
        ],200);
    }

    /**
     * Store event
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreEventRequest $request)
    {
        $response = $this->eventService->storeEvent($request);

        return response()->json([
            'message' => $response['message'],
            'data' => $response['data']
        ],$response['code']);
    }

    /**
     * Return a event by id
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $event = $this->eventService->getEvent($id);

        if (!$event) {
            return response()->json([
                'message' => 'Event not found'
            ],404);
        }

        return response()->json([
            'event' => $event
        ],200);
    }

    /**
     * Update an event by id
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateEventRequest $request, $id)
    {
        $event = $this->eventService->getEvent($id);

        if (!$event) {
            return response()->json([
                'message' => 'Event not found'
            ],404);
        }

        $response = $this->eventService->updateEvent($request,$id);

        return response()->json([
            'message' => $response['message'],
            'data' => $response['data']
        ],$response['code']);
    }

    /**
     * Remove an event by id
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $event = $this->eventService->getEvent($id);

        if (!$event) {
            return response()->json([
                'message' => 'Event not found'
            ],404);
        }

        $response = $this->eventService->removeEvent($id);

        return response()->json([
            'message' => $response['message']
        ],$response['code']);
    }
}
