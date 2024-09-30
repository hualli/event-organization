<?php

namespace App\Http\Controllers;

use App\Services\InscriptionService;
use App\Http\Requests\StoreInscriptionRequest;

class InscriptionController extends Controller
{
    private InscriptionService $inscriptionService;

    public function __construct(InscriptionService $inscriptionService){
        $this->inscriptionService = $inscriptionService;
    }

    /**
     * Store inscription
     *
     * @param  \App\Http\Requests\StoreInscriptionRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreInscriptionRequest $request){
        $inscription = $this->inscriptionService->getInscription($request);

        if ($inscription->isNotEmpty()) {
            return response()->json([
                'message' => 'The user is already registered for this event'
            ],404);
        }

        $response = $this->inscriptionService->storeInscription($request);

        return response()->json([
            'message' => $response['message'],
            'data' => $response['data']
        ],$response['code']);
    }

    /**
     * Returns a list of inscriptions by user id
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInscriptionsByUser($id){
        $inscriptions = $this->inscriptionService->getInscriptions($id);

        return response()->json([
            'events' => $inscriptions,
        ],200);
    }
}
