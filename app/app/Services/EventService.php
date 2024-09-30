<?php

namespace App\Services;

use App\Interfaces\EventRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventService
{
    private EventRepositoryInterface $eventRepositoryInterface;

    public function __construct(EventRepositoryInterface $eventRepositoryInterface)
    {
        $this->eventRepositoryInterface = $eventRepositoryInterface;
    }

    /**
     * List all events
     *
     * @return mixed
     */
    public function getEvents(){
        return $this->eventRepositoryInterface->getAll();
    }

    /**
     * Store event
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function storeEvent(Request $request){
        DB::beginTransaction();
        try {
            $event = $this->eventRepositoryInterface->store($request->all());
            DB::commit();
            return [
                'message' => 'Event created successfully',
                'data' => $event,
                'code' => 200
            ];
        } catch (\Exception $ex) {
            DB::rollBack();
            return [
                'message' => 'Error creating event',
                'data' => $ex,
                'code' => 500
            ];
        }
    }

    /**
     * Return an event by id
     *
     * @param  int  $id
     * @return mixed
     */
    public function getEvent($id){
        return $this->eventRepositoryInterface->getById($id);
    }

    /**
     * Update an event by id
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return array
     */
    public function updateEvent(Request $request, $id){
        DB::beginTransaction();
        try {
            $updatedEvent = $this->eventRepositoryInterface->update($request->all(), $id);
            DB::commit();
            return [
                'message' => 'Event updated successfully',
                'data' => $updatedEvent,
                'code' => 200
            ];
        } catch (\Exception $ex) {
            DB::rollBack();
            return [
                'message' => 'Error updating event',
                'data' => $ex,
                'code' => 500
            ];
        }
    }

    /**
     * Remove an event by id
     *
     * @param  int  $id
     * @return array
     */
    public function removeEvent($id){
        try {
            $this->eventRepositoryInterface->delete($id);
            return [
                'message' => 'Event '.$id.' successfully removed',
                'code' => 200
            ];
        } catch (\Exception $ex) {
            return [
                'message' => 'Error removing event - '.$ex,
                'code' => 500
            ];
        }
    }
}
