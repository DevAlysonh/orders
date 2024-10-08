<?php

namespace App\Traits\SwaggerDocs;

use OpenApi\Annotations as OA;

trait ProductControllerDocs
{
    /**
     * @OA\Post(
     *     path="/api/products",
     *     summary="Cadastrar um Novo Produto",
     *     description="Cria um novo produto, que deve, obrigatoriamente, pertencer a uma categoria.",
     *     tags={"Produtos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"category_id", "name", "price"},
     *             @OA\Property(
     *                 property="category_id",
     *                 description="ID da categoria, à qual o produto pertence.",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="name",
     *                 description="Nome do Produto",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="price",
     *                 description="Preço do produto. Deve ser um número, com no máximo duas casas decimais. Exemplos: 20 / 1.99",
     *                 type="float",
     *                 example="3.50"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Retornado quando um produto é cadastrado com sucesso.",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Produto cadastrado com sucesso."),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Suco de maçã"),
     *                 @OA\Property(property="category_id", type="integer", example=1),
     *                 @OA\Property(property="price", type="string", example="3.50")
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
     *                 @OA\Property(property="category_id", type="array", @OA\Items(type="string", example="A categoria não existe na base de dados.")),
     *                 @OA\Property(property="price", type="array", @OA\Items(type="string", example="O preço deve ter no máximo duas casas decimais."))
     *             ),
     *             @OA\Property(property="status_code", type="integer", example=422)
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Retornado quando ocorre algum erro interno durante o processamento da solicitação",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Erro interno do servidor."),
     *             @OA\Property(property="errors", type="array", @OA\Items(type="string", example="Ocorreu um erro ao processar sua solicitação, tente novamente em instantes.")),
     *             @OA\Property(property="status_code", type="integer", example=500)
     *         )
     *     )
     * )
     */
    public function productStoreDocs()
    {
        //
    }
}
