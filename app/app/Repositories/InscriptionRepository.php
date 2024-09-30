<?php

namespace App\Repositories;

use App\Interfaces\InscriptionRepositoryInterface;
use App\Models\Inscription;

class InscriptionRepository implements InscriptionRepositoryInterface
{
    public function getByIdUserIdEvent($user_id,$event_id)
    {
        return Inscription::where('user_id',$user_id)->where('event_id',$event_id)->get();
    }

    public function store(array $data)
    {
        return Inscription::create($data);
    }

    public function getByUser($id){
        return Inscription::where('user_id', $id)->get();
    }

}
