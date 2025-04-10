<?php

namespace App\Repositories;

use App\Models\Newsletter;

class NewsletterRepository
{
    public function all()
    {
        return Newsletter::all();
    }

    public function find($id)
    {
        return Newsletter::findOrFail($id);
    }

    public function create(array $data)
    {
        return Newsletter::create($data);
    }

    public function update(Newsletter $newsletter, array $data)
    {
        $newsletter->update($data);
        return $newsletter;
    }

    public function delete(Newsletter $newsletter)
    {
        return $newsletter->delete();
    }
}
