<?php

namespace App\Traits\SwaggerDocs;

use OpenApi\Annotations as OA;

trait OrderControllerDocs
{
    /**
     * @OA\Post(
     *     path="/orders",
     *     summary="Registrar um pedido",
     *     description="Essa rota registra um pedido com base nos produtos fornecidos.",
     *     tags={"Pedidos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="products",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="product_id",
     *                         type="integer",
     *                         description="ID do produto"
     *                     ),
     *                     @OA\Property(
     *                         property="quantity",
     *                         type="integer",
     *                         description="Quantidade do produto a ser adicionada ao pedido"
     *                     ),
     *                     @OA\Property(
     *                         property="price",
     *                         type="number",
     *                         format="float",
     *                         description="Preço unitário do produto"
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Pedido registrado com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Pedido registrado."),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="order_id", type="integer", example=17),
     *                 @OA\Property(property="order_status", type="string", example="open"),
     *                 @OA\Property(property="total_cost", type="string", example="5.00"),
     *                 @OA\Property(
     *                     property="products",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="product_id", type="integer", example=1),
     *                         @OA\Property(property="product_name", type="string", example="Pizza Marguerita"),
     *                         @OA\Property(property="price", type="string", example="2.50"),
     *                         @OA\Property(property="quantity", type="integer", example=2)
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="A validação dos dados falhou!"),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(
     *                     property="products.0.price",
     *                     type="array",
     *                     @OA\Items(type="string", example="O preço deve ter no máximo duas casas decimais.")
     *                 )
     *             ),
     *             @OA\Property(property="status_code", type="integer", example=422)
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Erro interno do servidor."),
     *             @OA\Property(property="errors", type="array",
     *                 @OA\Items(type="string", example="Ocorreu um erro ao processar sua solicitação, tente novamente em instantes.")
     *             ),
     *             @OA\Property(property="status_code", type="integer", example=500)
     *         )
     *     )
     * )
     */
    public function orderStoreDocs()
    {
        //
    }
}
