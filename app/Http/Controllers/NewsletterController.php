<?php

namespace App\Http\Controllers;

use App\Services\NewsletterService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Newsletters",
 *     description="API pour gérer les newsletters"
 * )
 */
class NewsletterController extends Controller
{
    protected $newsletterService;

    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }

    /**
     * @OA\Get(
     *     path="/api/newsletters",
     *     tags={"Newsletters"},
     *     summary="Lister toutes les newsletters",
     *     @OA\Response(response=200, description="Liste des newsletters")
     * )
     */
    public function index()
    {
        return response()->json($this->newsletterService->getAll());
    }

    /**
     * @OA\Post(
     *     path="/api/newsletters",
     *     tags={"Newsletters"},
     *     summary="Créer une nouvelle newsletter",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "content"},
     *             @OA\Property(property="title", type="string", maxLength=255, example="Newsletter d'avril"),
     *             @OA\Property(property="content", type="string", example="Contenu de la newsletter d'avril.")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Newsletter créée"),
     *     @OA\Response(response=422, description="Validation échouée")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        return response()->json($this->newsletterService->create($data), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/newsletters/{id}",
     *     tags={"Newsletters"},
     *     summary="Afficher une newsletter spécifique",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la newsletter",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Détails de la newsletter"),
     *     @OA\Response(response=404, description="Newsletter non trouvée")
     * )
     */
    public function show($id)
    {
        return response()->json($this->newsletterService->getById($id));
    }

    /**
     * @OA\Put(
     *     path="/api/newsletters/{id}",
     *     tags={"Newsletters"},
     *     summary="Mettre à jour une newsletter",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la newsletter",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", maxLength=255, example="Newsletter mise à jour"),
     *             @OA\Property(property="content", type="string", example="Nouveau contenu de la newsletter.")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Newsletter mise à jour"),
     *     @OA\Response(response=422, description="Validation échouée")
     * )
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        return response()->json($this->newsletterService->update($id, $data));
    }

    /**
     * @OA\Delete(
     *     path="/api/newsletters/{id}",
     *     tags={"Newsletters"},
     *     summary="Supprimer une newsletter",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la newsletter à supprimer",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Newsletter supprimée"),
     *     @OA\Response(response=404, description="Newsletter non trouvée")
     * )
     */
    public function destroy($id)
    {
        return response()->json($this->newsletterService->delete($id));
    }
}
