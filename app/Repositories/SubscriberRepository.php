<?php

namespace App\Repositories;

use App\Models\Subscriber;

class SubscriberRepository
{
    public function all()
    {
        return Subscriber::all();
    }

    public function find($id)
    {
        return Subscriber::findOrFail($id);
    }

    public function create(array $data)
    {
        return Subscriber::create($data);
    }

    public function update(Subscriber $subscriber, array $data)
    {
        $subscriber->update($data);
        return $subscriber;
    }

    public function delete(Subscriber $subscriber)
    {
        return $subscriber->delete();
    }
}
