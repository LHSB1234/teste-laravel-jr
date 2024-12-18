<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Prático</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

</head>
<body>
    <div class="container d-flex flex-column">
        <header class="mb-auto">
            <h1 class="display-4 font-weight-bold">Desenvolvedor Júnior (PHP/Laravel)</h1>
            <p class="lead">Teste Prático de desenvolvimento com Laravel</p>
        </header>

        <section class="mb-auto">
            <h2>Sobre o Teste</h2>
            <p>Este é um Teste Prático para mostrar os meus conhecimentos de Laravel. <br> O objetivo deste teste é avaliar as minhas habilidades em PHP, Laravel, MySQL, HTML, CSS e integração de APIs, especificamente com o Mercado Livre.</p>

            <h2>Como Funciona?</h2> 
            <ul class="list-unstyled"> 
                <li><i class="fas fa-check"></i> Explorar o Laravel e suas funcionalidades</li> 
                <li><i class="fas fa-check"></i> Integrar APIs externas, como a API do Mercado Livre</li> 
                <li><i class="fas fa-check"></i> Construir sistemas de autenticação, incluindo o fluxo OAuth2</li> 
                <li><i class="fas fa-check"></i> Criar dashboards e relatórios</li>
                <li><i class="fas fa-check"></i> Cadastro de produtos com nome, descrição, preço, quantidade, categoria e imagem</li> 
                <li><i class="fas fa-check"></i> Envio de informações de produtos e exibição da resposta da API do Mercado Livre</li> 
                <li><i class="fas fa-check"></i> Armazenamento do histórico de produtos cadastrados no MySQL</li>
            </ul>
            
            <div class="text-center mb-auto">
                <a href="{{ route('produtos.create') }}" class="btn btn-primary btn-lg">Cadastrar Produto</a>
                <a href="{{ route('produtos.index') }}" class="btn btn-primary btn-lg">Mostrar Produtos</a>
            </div>

        </section>
        
        <footer class="mb-auto">
            &copy;2024. Todos os direitos reservados.
            <div class="social-icons">
                <a href="https://github.com/LHSB1234" target="_blank" rel="noopener noreferrer"><i class="fab fa-github"></i></a>
                <a href="https://linkedin.com/in/leonardo-h-s-bento" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin"></i></a>
            </div>
        </footer>
    </div>
</body>
</html>
