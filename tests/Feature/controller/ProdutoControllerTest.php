<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class ProdutoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_product_success()
    {
        $productData = [
            'title' => 'Produto Teste',
            'description' => 'Descrição do produto de teste.',
            'price' => 100.00,
            'category_id' => 'MLB12345',
            'listing_type_id' => 'regular',
        ];

        $response = $this->post(route('produtos.store'), $productData);

        // Verificando se a mensagem de sucesso está presente na sessão
        $response->assertSessionHas('success', 'Produto cadastrado com sucesso!');
        $response->assertRedirect(route('produtos.index'));
    }

    public function test_store_product_fail_on_api_error()
    {
        $productData = [
            'title' => 'Produto Teste',
            'description' => 'Descrição do produto de teste.',
            'price' => 100.00,
            'category_id' => 'MLB12345',
            'listing_type_id' => 'regular',
        ];

        // Simulando erro ao cadastrar produto no Mercado Livre
        Http::fake([
            'https://api.mercadolivre.com/items' => Http::response([
                'message' => 'access_token.invalid',
                'error' => 'Invalid OAuth access token',
                'status' => 403,
            ], 403),
        ]);

        $response = $this->post(route('produtos.store'), $productData);

        // Verificando se a mensagem de erro está presente na sessão
        $response->assertSessionHas('errors', 'Erro ao cadastrar produto: Erro ao cadastrar produto no Mercado Livre: {"message":"access_token.invalid","error":"Invalid OAuth access token","status":403}');
        $response->assertRedirect();
    }
}
