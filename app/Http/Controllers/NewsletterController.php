<?php

namespace App\Http\Controllers;

use App\Services\NewsletterService;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    protected $newsletterService;

    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }

    public function index()
    {
        return response()->json($this->newsletterService->getAll());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        return response()->json($this->newsletterService->create($data), 201);
    }

    public function show($id)
    {
        return response()->json($this->newsletterService->getById($id));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        return response()->json($this->newsletterService->update($id, $data));
    }

    public function destroy($id)
    {
        return response()->json($this->newsletterService->delete($id));
    }
}
