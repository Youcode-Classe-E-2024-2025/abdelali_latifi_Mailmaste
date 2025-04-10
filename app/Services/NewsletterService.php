<?php

namespace App\Services;

use App\Repositories\NewsletterRepository;

class NewsletterService
{
    protected $newsletterRepository;

    public function __construct(NewsletterRepository $newsletterRepository)
    {
        $this->newsletterRepository = $newsletterRepository;
    }

    public function getAll()
    {
        return $this->newsletterRepository->all();
    }

    public function getById($id)
    {
        return $this->newsletterRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->newsletterRepository->create($data);
    }

    public function update($id, array $data)
    {
        $newsletter = $this->newsletterRepository->find($id);
        return $this->newsletterRepository->update($newsletter, $data);
    }

    public function delete($id)
    {
        $newsletter = $this->newsletterRepository->find($id);
        return $this->newsletterRepository->delete($newsletter);
    }
}

?>