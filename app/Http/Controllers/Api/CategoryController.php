<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateCategoryRequest;
use App\Services\Api\CategoryService;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;
use OpenApi\Annotations as OA;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService)
    {
    }

    /**
     * @OA\Post(
     *     path="/api/categories",
     *     summary="Registrar uma nova categoria.",
     *     description="Cria uma nova categoria de produtos. O campo nome é obrigatório e deve ser uma string válida.",
     *     tags={"Categorias"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(
     *                 property="name",
     *                 description="Nome da categoria",
     *                 type="string"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Categoria registrada.",
     *         @OA\JsonContent(
     *             @OA\Property(property="msg", type="string", example="Categoria cadastrada."),
     *             @OA\Property(property="category", type="object",
     *                 @OA\Property(property="id", type="integer", example=5),
     *                 @OA\Property(property="name", type="string", example="Lanches")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requisição inválida, campos inválidos.",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="name", type="array", @OA\Items(type="string", example="O campo name é orbigatório."))
     *             )
     *         )
     *     )
     * )
     */
    public function store(CreateCategoryRequest $request): JsonResponse
    {
        try {
            $category = $this->categoryService
                ->create($request->validated());

            return response()->json([
                'msg' => $this->categoryService->getLastMessage(),
                'category' => $category
            ], 201);
        } catch (InvalidArgumentException $e) {
            return response()->json([
                'error' => $this->categoryService->getLastMessage(),
            ], 400);
        }
    }
}
