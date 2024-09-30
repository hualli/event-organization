<?php

namespace App\Services;

use App\Interfaces\EventRepositoryInterface;
use App\Interfaces\InscriptionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class InscriptionService
{
    private InscriptionRepositoryInterface $inscriptionRepositoryInterface;
    private EventRepositoryInterface $eventRepositoryInterface;

    public function __construct(InscriptionRepositoryInterface $inscriptionRepositoryInterface,EventRepositoryInterface $eventRepositoryInterface)
    {
        $this->inscriptionRepositoryInterface = $inscriptionRepositoryInterface;
        $this->eventRepositoryInterface = $eventRepositoryInterface;
    }

    /**
     * Return an inscription by user ID and event ID
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInscription(Request $request)
    {
        return $this->inscriptionRepositoryInterface->getByIdUserIdEvent($request->user_id,$request->event_id);
    }

    /**
     * Store a new inscription
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function storeInscription(Request $request){
        DB::beginTransaction();
        try {
            $today = Carbon::now();

            $event = $this->eventRepositoryInterface->getById($request->event_id);
            $dateEvent = Carbon::parse($event->date_time);

            if ($dateEvent > $today && $event->status == 'publicado'){

                $data = [
                    'date_time' => $today->format('Y-m-d H:i:s'),
                    'user_id' => $request->user_id,
                    'event_id' => $request->event_id,
                ];

                $inscription = $this->inscriptionRepositoryInterface->store($data);

                $response = [
                    'message' => 'Inscription created successfully',
                    'data' => $inscription,
                    'code' => 200,
                ];
            }else{
                $response = [
                    'message' => 'Error creating inscription',
                    'data' => '',
                    'code' => 500,
                ];
            }

            DB::commit();
            return $response;
        } catch (\Exception $ex) {
            DB::rollBack();
            return [
                'message' => 'Error creating inscription',
                'data' => $ex,
                'code' => 500
            ];
        }
    }

    /**
     * List all inscriptions for user.
     *
     * @param  int  $id
     * @return mixed
     */
    public function getInscriptions($id){
        return $this->inscriptionRepositoryInterface->getByUser($id);
    }

}
