<?php

namespace App\Repositories;

use App\Models\Campaign;

class CampaignRepository
{
    public function all()
    {
        return Campaign::all();
    }

    public function find($id)
    {
        return Campaign::findOrFail($id);
    }

    public function create(array $data)
    {
        return Campaign::create($data);
    }

    public function update(Campaign $campaign, array $data)
    {
        $campaign->update($data);
        return $campaign;
    }

    public function delete(Campaign $campaign)
    {
        return $campaign->delete();
    }
}
