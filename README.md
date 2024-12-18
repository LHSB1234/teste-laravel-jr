# Projeto Laravel - Integração com Mercado Livre

Este projeto Laravel foi desenvolvido para integrar produtos com a API do Mercado Livre. Ele permite gerenciar produtos localmente e sincronizá-los com o Mercado Livre.

## Funcionalidades

- **Autenticação com o Mercado Livre:**  
  - Geração e renovação de tokens de acesso via OAuth2.
- **Gerenciamento de Produtos:**  
  - CRUD de produtos com integração direta ao Mercado Livre.
  - Cadastro de produtos com categorias e imagens.
- **Visualização e Paginação de Produtos:**  
  - Listagem de produtos locais com paginação.
- **Sincronização com o Mercado Livre:**  
  - Produtos cadastrados localmente são sincronizados automaticamente.

---

## Tecnologias Utilizadas

- **Framework:** Laravel 5.11.0  
- **Linguagem:** PHP 8.2.12  
- **Banco de Dados:** MySQL  
- **Integração:** API do Mercado Livre  

---

## Requisitos de Instalação

Certifique-se de que seu ambiente de desenvolvimento atende aos seguintes requisitos:

1. **PHP**: Versão 8.2.12 ou superior.

2. **Composer**: Gerenciador de dependências PHP.  

3. **Node.js e npm/yarn**: Utilizados para gerenciar dependências front-end.  

4. **Banco de Dados MySQL**: O sistema foi projetado para MySQL, mas pode ser adaptado para outros bancos.

5. **Servidor Web**: Utilize o servidor embutido do Laravel (`php artisan serve`) e algo como Apache ou Nginx.

---

## Como Configurar o Projeto

Siga os passos abaixo para rodar este projeto localmente:

### 1. Clonar o repositório

Use o comando abaixo para clonar o repositório:

```bash
git clone https://github.com/itamogi/teste-laravel-jr.git
cd teste-laravel-jr
```

---

### 2. Instalar Dependências

#### 2.1. Dependências PHP

Instale as dependências do Laravel:

```bash
composer install
```

#### 2.2. Dependências Node.js

Instale as dependências front-end:

```bash
npm install
```

---

### 3. Configurar o Ambiente

#### 3.1. Arquivo `.env`

Copie o arquivo de exemplo `.env.example` e renomeie-o para `.env`:

```bash
cp .env.example .env
```

Depois, configure as variáveis do Mercado Livre e do banco de dados no arquivo `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha

MERCADO_LIVRE_CLIENT_ID=seu_client_id
MERCADO_LIVRE_CLIENT_SECRET=seu_client_secret
MERCADO_LIVRE_REDIRECT_URI=http://localhost:8000/callback
```

---

### 4. Gerar Chave da Aplicação

Execute o seguinte comando para gerar a chave da aplicação:

```bash
php artisan key:generate
```

---

### 5. Configurar e Migrar o Banco de Dados

#### 5.1. Executar as Migrações

Crie as tabelas no banco de dados com o comando:

```bash
php artisan migrate
```

---

### 6. Rodar o Projeto

Inicie o servidor de desenvolvimento com o comando:

```bash
php artisan serve
```

O projeto estará disponível no navegador em:  
[http://localhost:8000](http://localhost:8000)

---

## Estrutura do Projeto

- **`MercadoLivreController.php`**:  
  Controlador responsável pela autenticação e comunicação com a API do Mercado Livre.  
  - Autoriza e renova tokens de acesso.  
  - Recupera dados de usuários autenticados.  

- **`ProdutoController.php`**:  
  Controlador para gerenciar produtos.  
  - Cadastra produtos com validação de dados e imagens.  
  - Sincroniza produtos com o Mercado Livre.  
  - Lista produtos locais com paginação.

---

## Fluxo de Funcionalidades

1. **Autenticação com Mercado Livre**  
   O usuário é redirecionado para o Mercado Livre para autorizar o acesso à aplicação. Após o processo, o token é salvo no cache para ser usado nas requisições subsequentes.

2. **Cadastro de Produtos**  
   Produtos podem ser cadastrados localmente e enviados automaticamente para o Mercado Livre com os seguintes atributos:  
   - Nome, descrição, preço, quantidade, categoria e imagem.

3. **Listagem de Produtos**  
   Os produtos cadastrados são exibidos em uma interface com suporte à paginação.

---

## Testes Automatizados

Execute os testes do projeto com o comando:

```bash
php artisan test
```

---

## Possíveis Problemas e Soluções

1. **Erro de Autenticação no Mercado Livre**  
   - Certifique-se de que as variáveis `MERCADO_LIVRE_CLIENT_ID` e `MERCADO_LIVRE_CLIENT_SECRET` estão corretas no `.env`.  
   - Verifique se o `redirect_uri` é o mesmo configurado no painel do Mercado Livre.

2. **Erro ao Cadastrar Produtos**  
   - Certifique-se de que o produto tem todos os campos obrigatórios preenchidos.  

---

## Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais informações.
```

---