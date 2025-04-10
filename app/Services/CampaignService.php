<?php

namespace App\Services;

use App\Models\Campaign;
use Illuminate\Support\Facades\Auth;

class CampaignService
{
    /**
     * Crée une nouvelle campagne
     */
    public function create(array $data)
    {
        // Ajouter l'ID de l'utilisateur connecté
        $data['user_id'] = Auth::id();

        // Crée la campagne et la retourne
        return Campaign::create($data);
    }

    /**
     * Récupère toutes les campagnes
     */
    public function getAll()
    {
        return Campaign::all();
    }

    /**
     * Récupère une campagne par ID
     */
    public function getById($id)
    {
        return Campaign::findOrFail($id);
    }

    /**
     * Met à jour une campagne
     */
    public function update($id, array $data)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->update($data);
        return $campaign;
    }

    /**
     * Supprime une campagne
     */
    public function delete($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->delete();
        return response()->json(['message' => 'Campaign deleted successfully']);
    }
}
