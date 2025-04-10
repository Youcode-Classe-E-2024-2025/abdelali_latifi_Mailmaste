<?php

namespace App\Http\Controllers;

use App\Services\SubscriberService;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    protected $subscriberService;

    public function __construct(SubscriberService $subscriberService)
    {
        $this->subscriberService = $subscriberService;
    }

    public function index()
    {
        return response()->json($this->subscriberService->getAll());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:subscribers,email',
            'name' => 'nullable|string|max:255',
        ]);

        return response()->json($this->subscriberService->create($data), 201);
    }

    public function show($id)
    {
        return response()->json($this->subscriberService->getById($id));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'email' => 'sometimes|email|unique:subscribers,email,' . $id,
            'name' => 'sometimes|string|max:255',
        ]);

        return response()->json($this->subscriberService->update($id, $data));
    }

    public function destroy($id)
    {
        return response()->json($this->subscriberService->delete($id));
    }
}
