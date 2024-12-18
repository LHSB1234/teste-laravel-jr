<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Services\MercadoLivreService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProdutoController extends Controller
{
    public function create()
    {
        // Obtém categorias do Mercado Livre
        $categories = Http::get('https://api.mercadolibre.com/sites/MLB/categories')->json();
        return view('produtos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Verifique os dados recebidos no formulário
        Log::info('Dados recebidos:', $request->all());

        // Validação dos dados do formulário
        $validated = $request->validate([
            'nome' => 'required|string|max:255|unique:produtos,nome',
            'descricao' => 'required|string|max:1000',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer',
            'categoria' => 'required|string',  // Categoria deve ser um ID válido
            'listing_type_id' => 'nullable|string',  // Validação para o novo campo
            'imagem' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:10240',  // Validação para imagem
        ]);

        // Log para confirmar os dados validados
        Log::info('Dados validados:', $validated);

        // Início da transação para garantir integridade
        DB::beginTransaction();

        try {
            // Armazenamento da imagem
            if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
                $imagemName = now()->format('Ymd_His_V') . '.' . $request->file('imagem')->getClientOriginalExtension();
                $imagemPath = $request->file('imagem')->storeAs('produtos', $imagemName, 'public');
                $imagemUrl = Storage::url($imagemPath);
            } else {
                $imagemUrl = null;  // Caso não tenha imagem, define como nulo
            }

            // Cadastro no Mercado Livre
            $mercadoLivreService = new MercadoLivreService();
            $mercadoLivreData = $mercadoLivreService->cadastrarProduto([
                'nome' => $validated['nome'],
                'descricao' => $validated['descricao'],
                'preco' => $validated['preco'],
                'quantidade' => $validated['quantidade'],
                'categoria' => $validated['categoria'],
                'imagem' => $imagemUrl,
            ]);

            // Verificar se o cadastro no Mercado Livre foi bem-sucedido
            if (!isset($mercadoLivreData['id'])) {
                throw new \Exception('Erro ao cadastrar produto no Mercado Livre.');
            }

            // Cadastro do produto no banco de dados, incluindo o novo campo 'listing_type_id'
            $produto = Produto::create([
                'nome' => $validated['nome'],
                'descricao' => $validated['descricao'],
                'preco' => $validated['preco'],
                'quantidade' => $validated['quantidade'],
                'categoria' => $validated['categoria'],
                'listing_type_id' => $validated['listing_type_id'] ?? null, // Novo campo opcional
                'imagem' => $imagemPath ?? null,
                'mercadolivre_id' => $mercadoLivreData['id'],
            ]);

            // Log de sucesso
            Log::info('Produto criado com sucesso: ' . json_encode($produto));

            // Commit na transação
            DB::commit();

            return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
        } catch (\Exception $e) {
            // Rollback em caso de erro
            DB::rollBack();
            Log::error('Erro ao cadastrar produto: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erro ao cadastrar produto: ' . $e->getMessage());
        }
    }

    // Método para listar todos os produtos
    public function index()
    {
        $produtos = Produto::paginate(5); // Aqui estamos usando a paginação
    
        // Retorna a view com a coleção de produtos paginados
        return view('produtos.index', compact('produtos'));
    }
    
}
