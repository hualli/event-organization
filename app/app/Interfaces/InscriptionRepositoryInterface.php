<?php

namespace App\Interfaces;

interface InscriptionRepositoryInterface
{
    public function getByIdUserIdEvent($user_id,$event_id);
    public function store(array $data);
    public function getByUser($id);
}
