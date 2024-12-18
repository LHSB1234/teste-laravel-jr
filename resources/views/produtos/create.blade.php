<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Produtos</h1>
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required>

            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" required>{{ old('descricao') }}</textarea>

            <label for="preco">Preço:</label>
            <input type="number" name="preco" id="preco" step="0.01" value="{{ old('preco') }}" required>

            <label for="quantidade">Quantidade:</label>
            <input type="number" name="quantidade" id="quantidade" value="{{ old('quantidade') }}" required>

            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria" required>
                @foreach($categories as $category)
                    <option value="{{ $category['id'] }}" @if(old('categoria') == $category['id']) selected @endif>{{ $category['name'] }}</option>
                @endforeach
            </select>

            <div class="form-group">
                <label for="listing_type_id">Tipo de Listagem</label>
                <input type="text" class="form-control" name="listing_type_id" id="listing_type_id" value="{{ old('listing_type_id') }}">
            </div>

            <label for="imagem">Imagem:</label>
            <input type="file" name="imagem" id="imagem">

            <div class="button-group">
                <button type="submit">Salvar</button> 
                <button type="reset">Limpar</button> 
                <button type="button" onclick="window.location.href='http://127.0.0.1:8000/';">Voltar</button>
            </div>
        </form>
    </div>
</body>
</html>
