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
    public function categoryStoreDocs()
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/api/categories/menu",
     *     summary="Retorna os itens do cardápio",
     *     description="Retorna uma lista de categorias e seus respectivos produtos com paginação.",
     *     tags={"Cardápio"},
     *     @OA\Parameter(
     *          name="perPage",
     *          in="query",
     *          description="Número de itens por página (opcional, valor padrão é 10)",
     *          required=false,
     *          @OA\Schema(type="integer", default=10)
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Retornado quando o sistema consgue encontrar categorias cadastradas.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Itens do cardápio."),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="menu",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="name", type="string", example="Massas"),
     *                         @OA\Property(
     *                             property="products",
     *                             type="array",
     *                             @OA\Items(
     *                                 type="object",
     *                                 @OA\Property(property="id", type="integer", example=1),
     *                                 @OA\Property(property="name", type="string", example="Pizza Marguerita"),
     *                                 @OA\Property(property="price", type="string", example="59.99")
     *                             )
     *                         )
     *                     )
     *                 ),
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *                 @OA\Property(property="last_page", type="integer", example=1)
     *             ),
     *             @OA\Property(property="status_code", type="integer", example=200)
     *         )
     *     ),
     *     @OA\Response(
     *         response="204",
     *         description="Retornado quando nenhuma categoria é encontrada."
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
    public function categoryMenuListDocs()
    {
        //
    }
}
