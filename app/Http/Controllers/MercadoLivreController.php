<?php

namespace Tests\Unit;

use App\Services\MercadoLivreService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class MercadoLivreServiceTest extends TestCase
{
    public function test_cadastrar_produto_success()
    {
        $productData = [
            'title' => 'Produto Teste',
            'description' => 'Descrição do produto de teste.',
            'price' => 100.00,
            'category_id' => 'MLB12345',
            'listing_type_id' => 'regular',
        ];

        // Simulando a resposta de sucesso da API
        Http::fake([
            'https://api.mercadolivre.com/items' => Http::response(['id' => 'MLB123456'], 200),
        ]);

        $mercadoLivreService = new MercadoLivreService();
        $response = $mercadoLivreService->cadastrarProduto($productData);

        $this->assertArrayHasKey('id', $response);
    }

    public function test_cadastrar_produto_fail_on_api_error()
    {
        $productData = [
            'title' => 'Produto Teste',
            'description' => 'Descrição do produto de teste.',
            'price' => 100.00,
            'category_id' => 'MLB12345',
            'listing_type_id' => 'regular',
        ];

        // Simulando erro na API com campos obrigatórios faltando
        Http::fake([
            'https://api.mercadolivre.com/items' => Http::response([
                'message' => 'body.required_fields',
                'error' => 'validation_error',
                'status' => 400,
                'cause' => [
                    [
                        'message' => 'The body does not contains some or none of the following properties [listing_type_id, title, category_id]',
                    ]
                ],
            ], 400),
        ]);

        $mercadoLivreService = new MercadoLivreService();

        // Espera-se que uma exceção seja lançada
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Erro ao cadastrar produto no Mercado Livre. Status: 400 Detalhes: {"message":"body.required_fields","error":"validation_error","status":400,"cause":[{"message":"The body does not contains some or none of the following properties [listing_type_id, title, category_id]"}]}');

        $mercadoLivreService->cadastrarProduto($productData);
    }
}
