<?php

namespace App\Services;

use App\Repositories\SubscriberRepository;

class SubscriberService
{
    protected $subscriberRepository;

    public function __construct(SubscriberRepository $subscriberRepository)
    {
        $this->subscriberRepository = $subscriberRepository;
    }

    public function getAll()
    {
        return $this->subscriberRepository->all();
    }

    public function getById($id)
    {
        return $this->subscriberRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->subscriberRepository->create($data);
    }

    public function update($id, array $data)
    {
        $subscriber = $this->subscriberRepository->find($id);
        return $this->subscriberRepository->update($subscriber, $data);
    }

    public function delete($id)
    {
        $subscriber = $this->subscriberRepository->find($id);
        return $this->subscriberRepository->delete($subscriber);
    }
}
