<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Produtos</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                    <tr>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->descricao }}</td>
                        <td>{{ $produto->preco }}</td>
                        <td>{{ $produto->quantidade }}</td>
                        <td>
                            <a href="#">Editar</a> |
                            <a href="#">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Links para navegação das páginas -->
        <div class="pagination">
            {{ $produtos->links() }}
        </div>

        <button type="button" onclick="window.location.href='http://127.0.0.1:8000/';">Voltar</button>

    </div>
</body>
</html>
