<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MercadoLivreService
{
    public function cadastrarProduto($productData)
    {
        $accessToken = env('MERCADO_LIVRE_ACCESS_TOKEN');
        $client = Http::withToken($accessToken);
        $response = $client->post('https://api.mercadolibre.com/items', [
            'json' => [
                'title' => $productData['nome'],
                'price' => $productData['preco'],
                'currency_id' => 'BRL',
                'available_quantity' => $productData['quantidade'],
                'category_id' => $productData['categoria'],
                'pictures' => [
                    ['source' => $productData['imagem']],
                ],
                'description' => $productData['descricao'],
            ]
        ]);
    
        if ($response->failed()) {
            throw new \Exception('Erro ao cadastrar produto no Mercado Livre. Status: ' . $response->getStatusCode() . ' Detalhes: ' . $response->body());
        }
    
        return json_decode($response->getBody()->getContents(), true);
    }
}
