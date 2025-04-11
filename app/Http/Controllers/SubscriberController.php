<?php

namespace App\Http\Controllers;

use App\Services\SubscriberService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Subscribers",
 *     description="API pour gérer les abonnés"
 * )
 */
class SubscriberController extends Controller
{
    protected $subscriberService;

    public function __construct(SubscriberService $subscriberService)
    {
        $this->subscriberService = $subscriberService;
    }

    /**
     * @OA\Get(
     *     path="/api/subscribers",
     *     tags={"Subscribers"},
     *     summary="Lister tous les abonnés",
     *     @OA\Response(response=200, description="Liste des abonnés")
     * )
     */
    public function index()
    {
        return response()->json($this->subscriberService->getAll());
    }

    /**
     * @OA\Post(
     *     path="/api/subscribers",
     *     tags={"Subscribers"},
     *     summary="Créer un nouvel abonné",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email"},
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="name", type="string", example="John Doe")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Abonné créé avec succès"),
     *     @OA\Response(response=422, description="Erreur de validation")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:subscribers,email',
            'name' => 'nullable|string|max:255',
        ]);

        return response()->json($this->subscriberService->create($data), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/subscribers/{id}",
     *     tags={"Subscribers"},
     *     summary="Afficher les détails d’un abonné",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l’abonné",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Détails de l’abonné"),
     *     @OA\Response(response=404, description="Abonné non trouvé")
     * )
     */
    public function show($id)
    {
        return response()->json($this->subscriberService->getById($id));
    }

    /**
     * @OA\Put(
     *     path="/api/subscribers/{id}",
     *     tags={"Subscribers"},
     *     summary="Mettre à jour un abonné",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l’abonné",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", format="email", example="nouveau@example.com"),
     *             @OA\Property(property="name", type="string", example="Nouveau Nom")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Abonné mis à jour"),
     *     @OA\Response(response=422, description="Erreur de validation")
     * )
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'email' => 'sometimes|email|unique:subscribers,email,' . $id,
            'name' => 'sometimes|string|max:255',
        ]);

        return response()->json($this->subscriberService->update($id, $data));
    }

    /**
     * @OA\Delete(
     *     path="/api/subscribers/{id}",
     *     tags={"Subscribers"},
     *     summary="Supprimer un abonné",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de l’abonné",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Abonné supprimé"),
     *     @OA\Response(response=404, description="Abonné non trouvé")
     * )
     */
    public function destroy($id)
    {
        return response()->json($this->subscriberService->delete($id));
    }
}
