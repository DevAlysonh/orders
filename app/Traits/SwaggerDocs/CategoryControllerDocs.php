<?php

namespace App\Traits\SwaggerDocs;

use OpenApi\Annotations as OA;

trait CategoryControllerDocs
{
    /**
     * @OA\Post(
     *     path="/api/categories",
     *     summary="Cadastrar uma Nova Categoria",
     *     description="Cria uma nova categoria, através de um nome fornecido pelo usuário.",
     *     tags={"Categorias"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(
     *                 property="name",
     *                 description="Nome da categoria a ser criada.",
     *                 type="string"
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Retornado quando uma categoria é cadastrada com sucesso.",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Categoria cadastrada com sucesso."),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Bebidas"),
     *             ),
     *             @OA\Property(property="status_code", type="integer", example=201)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Retornado quando ocorre algum erro na validação da requisição",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="A validação dos dados falhou!"),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="name", type="array", @OA\Items(type="string", example="Campo obrigatório")),
     *             ),
     *             @OA\Property(property="status_code", type="integer", example=422)
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Retornado quando ocorre algum erro interno interno durante o processamento da solicitação",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Erro interno do servidor."),
     *             @OA\Property(property="errors", type="array", @OA\Items(type="string", example="Ocorreu um erro ao processar sua solicitação, tente novamente em instantes.")),
     *             @OA\Property(property="status_code", type="integer", example=500)
     *         )
     *     )
     * )
     */
    public function getCategoryStoreDocs()
    {
        //
    }
}
