<?php

namespace App\Interfaces;

interface EventRepositoryInterface
{
    public function getAll();
    public function store(array $data);
    public function getById($id);
    public function update(array $data, $id);
    public function delete($id);
}
