

## Laravel Flor de Cacau

Projeto desenvolvido com o intuito de facilitar a venda de doces na região oferecendo uma maneira rápida e fácil de fazer pedidos online.

### Funcionalidades
- Catálogo de produtos
- Carrinho de compras
- Pedido pelo Whatsapp

### Funcionalidades do Admin
- Alterar imagem do produto
- Alterar o preço


### Imagens do Projeto

![Página inicial](public/img/home.png)
---
![Sobre](public/img/about.png)
---
![Carrginho](public/img/carrinho.png)

## Instalação

1. Clone o repositório:
    ```bash
    git clone https://github.com/seu-usuario/laravel-flor-de-cacau.git
    ```
2. Instale as dependências:
    ```bash
    composer install
    ```
3. Configure o arquivo `.env`:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4. Execute as migrações:
    ```bash
    php artisan migrate
    ```


## Pendências

- [ ] Implementar possibilidade de excluir produtos
- [ ] Possibilidade de gerar relatórios
- [ ] Adicionar menu responsivo
- [ ] Implementar CRUD de categorias


## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou enviar pull requests.



