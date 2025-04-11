<?php

namespace App\Http\Controllers;

use App\Services\CampaignService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Campaigns",
 *     description="API pour gérer les campagnes de newsletters"
 * )
 */
class CampaignController extends Controller
{
    protected $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    /**
     * @OA\Get(
     *     path="/api/campaigns",
     *     tags={"Campaigns"},
     *     summary="Lister toutes les campagnes",
     *     @OA\Response(response=200, description="Liste des campagnes")
     * )
     */
    public function index()
    {
        return response()->json($this->campaignService->getAll());
    }

    /**
     * @OA\Post(
     *     path="/api/campaigns",
     *     tags={"Campaigns"},
     *     summary="Créer une nouvelle campagne",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"newsletter_id", "scheduled_at"},
     *             @OA\Property(property="newsletter_id", type="integer", example=1),
     *             @OA\Property(property="scheduled_at", type="string", format="date-time", example="2025-04-20 10:00:00")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Campagne créée"),
     *     @OA\Response(response=422, description="Validation échouée")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'newsletter_id' => 'required|exists:newsletters,id',
            'scheduled_at' => 'required|date',
        ]);

        return response()->json($this->campaignService->create($data), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/campaigns/{id}",
     *     tags={"Campaigns"},
     *     summary="Afficher une campagne spécifique",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la campagne",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Détails de la campagne"),
     *     @OA\Response(response=404, description="Campagne non trouvée")
     * )
     */
    public function show($id)
    {
        return response()->json($this->campaignService->getById($id));
    }

    /**
     * @OA\Put(
     *     path="/api/campaigns/{id}",
     *     tags={"Campaigns"},
     *     summary="Mettre à jour une campagne",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la campagne à modifier",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="newsletter_id", type="integer", example=2),
     *             @OA\Property(property="scheduled_at", type="string", format="date-time", example="2025-04-21 14:00:00")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Campagne mise à jour"),
     *     @OA\Response(response=422, description="Validation échouée")
     * )
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'newsletter_id' => 'sometimes|exists:newsletters,id',
            'scheduled_at' => 'sometimes|date',
        ]);

        return response()->json($this->campaignService->update($id, $data));
    }

    /**
     * @OA\Delete(
     *     path="/api/campaigns/{id}",
     *     tags={"Campaigns"},
     *     summary="Supprimer une campagne",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la campagne à supprimer",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Campagne supprimée"),
     *     @OA\Response(response=404, description="Campagne non trouvée")
     * )
     */
    public function destroy($id)
    {
        return response()->json($this->campaignService->delete($id));
    }
}
