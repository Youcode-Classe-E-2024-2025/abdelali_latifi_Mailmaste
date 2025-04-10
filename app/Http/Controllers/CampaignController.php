<?php

namespace App\Http\Controllers;

use App\Services\CampaignService;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    protected $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    public function index()
    {
        return response()->json($this->campaignService->getAll());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'newsletter_id' => 'required|exists:newsletters,id',
            'scheduled_at' => 'required|date',
        ]);

        return response()->json($this->campaignService->create($data), 201);
    }

    public function show($id)
    {
        return response()->json($this->campaignService->getById($id));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'newsletter_id' => 'sometimes|exists:newsletters,id',
            'scheduled_at' => 'sometimes|date',
        ]);

        return response()->json($this->campaignService->update($id, $data));
    }

    public function destroy($id)
    {
        return response()->json($this->campaignService->delete($id));
    }
}
