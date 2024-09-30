<?php

namespace App\Repositories;

use App\Interfaces\EventRepositoryInterface;
use App\Models\Event;

class EventRepository implements EventRepositoryInterface
{
    public function getAll()
    {
        return Event::all();
    }

    public function store(array $data)
    {
        return Event::create($data);
    }

    public function getById($id)
    {
        return Event::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        Event::whereId($id)->update($data);
        return Event::find($id);
    }

    public function delete($id)
    {
        return Event::destroy($id);
    }
}
