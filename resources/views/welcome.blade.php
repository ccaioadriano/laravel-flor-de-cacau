<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flor de Cacau - Doces Artesanais</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Configuração das cores personalizadas -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#143151',
                        'primary-dark': '#0c1f33',
                    }
                }
            }
        }
    </script>

    <!-- Estilos adicionais -->
    <style type="text/tailwindcss">
        @layer utilities {
            .transition-custom {
                transition: all 0.3s ease;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Cabeçalho -->
    <header class="bg-[#143151] shadow-lg">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="text-2xl font-bold text-white">
                    Flor de Cacau
                </div>
                <div class="flex items-center space-x-8">
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#" class="text-white hover:text-gray-200 transition-custom">Início</a>
                        <a href="#produtos" class="text-white hover:text-gray-200 transition-custom">Produtos</a>
                        <a href="#sobre" class="text-white hover:text-gray-200 transition-custom">Sobre</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="container mx-auto px-6 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-[#143151] mb-4">
                Amor em forma de Doces 💙
            </h1>
            <p class="text-lg text-gray-600 mb-8">
                Descubra o sabor único dos nossos doces artesanais
            </p>
        </div>
    </section>

    <!-- Produtos -->
    <section id="produtos" class="container mx-auto px-6 py-16">
        <h2 class="text-3xl font-bold text-center text-[#143151] mb-12">Nossos Produtos</h2>

        {{-- <!-- Filtro Simples -->
        <div class="mb-8 flex justify-center">
            <div class="inline-flex rounded-md shadow-sm" role="group">
                <button type="button"
                    class="filter-btn active px-4 py-2 text-sm font-medium bg-[#143151] text-white rounded-l-lg hover:bg-[#0c1f33]"
                    data-filter="all">
                    Todos
                </button>
                <button type="button"
                    class="filter-btn px-4 py-2 text-sm font-medium bg-gray-200 text-gray-700 hover:bg-gray-300"
                    data-filter="brigadeiros">
                    Brigadeiros
                </button>
                <button type="button"
                    class="filter-btn px-4 py-2 text-sm font-medium bg-gray-200 text-gray-700 hover:bg-gray-300"
                    data-filter="bolos">
                    Bolos
                </button>
                <button type="button"
                    class="filter-btn px-4 py-2 text-sm font-medium bg-gray-200 text-gray-700 rounded-r-lg hover:bg-gray-300"
                    data-filter="trufas">
                    Trufas
                </button>
            </div>
        </div> --}}

        <!-- Produtos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($products as $product)
                <div class="product-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300"
                    data-category="{{ $product->category ?? 'outros' }}">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-[#143151] mb-2">{{ $product->title }}</h3>
                        <img src="{{ $product->image ?? asset('storage/brigadeiros.png') }}" alt="{{ $product->title }}"
                            class="w-full h-48 object-cover mb-4 rounded-md">
                        <p class="text-[#143151] font-bold mt-4">R$ {{ number_format($product->price / 100, 2, ',', '.') }}
                        </p>
                        <button
                            onclick="addToCart('{{ $product->title }}', {{ $product->price / 100 }}, '{{ $product->image ?? asset('storage/brigadeiros.png') }}')"
                            class="mt-4 bg-[#143151] text-white px-4 py-2 rounded-md hover:bg-[#0c1f33] transition-all duration-300 w-full">
                            Adicionar ao carrinho
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Paginação -->
        <div class="mt-12">
            {{ $products->links() }}
        </div>
    </section>

    <!-- Botão flutuante do WhatsApp -->
    <a href="https://wa.me/31994409981" target="_blank"
        class="fixed bottom-[10%] right-6 bg-green-500 text-white w-14 h-14 flex items-center justify-center rounded-full shadow-lg hover:bg-green-600 hover:scale-110 transition-all duration-300 z-50">
        <i class="fab fa-whatsapp text-3xl"></i>
    </a>

    <!--Carrinho -->
    <button id="cart-button"
        class="fixed bottom-6 right-6 bg-[#0c1f33] text-white w-14 h-14 flex items-center justify-center rounded-full shadow-lg hover:scale-110 transition-all duration-300 z-50">
        <i class="fas fa-shopping-cart text-2xl"></i>
        <span id="cart-count"
            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
            0
        </span>
    </button>

    <!-- Modal do Carrinho -->
    <div id="cart-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[100] hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <div class="bg-[#143151] text-white px-6 py-4 flex justify-between items-center">
                <h3 class="text-xl font-semibold">Seu Carrinho</h3>
                <button id="close-cart" class="text-white hover:text-gray-300">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="p-6">
                <div id="cart-items" class="max-h-60 overflow-y-auto mb-4">
                    <!-- Os itens do carrinho serão inseridos aqui via JavaScript -->
                    <div class="text-gray-500 text-center py-4">Seu carrinho está vazio</div>
                </div>

                <div class="border-t pt-4">
                    <div class="flex justify-between mb-4">
                        <span class="font-semibold text-[#143151]">Total:</span>
                        <span id="cart-total" class="font-semibold text-[#143151]">R$ 0,00</span>
                    </div>


                    <div class="flex gap-2 mb-3" id="clearCartButton">
                        <!-- Botão Esvaziar Carrinho -->
                    </div>

                    <button id="checkout-button" onclick="checkout()"
                        class="w-full bg-[#143151] text-white py-3 rounded-md hover:bg-[#0c1f33] transition-all duration-300">
                        Finalizar Pedido
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-[#143151] text-white py-8 mt-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4">Flor de Cacau</h3>
                    <p class="text-gray-300">Doces artesanais feitos com amor e dedicação</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Contato</h3>
                    <p class="text-gray-300">WhatsApp: +55 (31) 99561-9393</p>
                    <p class="text-gray-300">Email: contato@flordecacau.com</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Horário</h3>
                    <p class="text-gray-300">Segunda a Sábado</p>
                    <p class="text-gray-300">09:00 - 18:00</p>
                </div>
            </div>
            <div class="text-center mt-8 pt-8 border-t border-gray-700">
                <p>&copy; 2025 Flor de Cacau. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript para o carrinho -->
    <script>
        // Inicialização do carrinho
        let cart = [];
        const clearCartButton = document.getElementById('clearCartButton');

        function clearCart() {
            cart = [];
            updateCart();
        }

        // Função para adicionar produto ao carrinho
        function addToCart(title, price, image) {
            // Verificar se o produto já está no carrinho
            const existingItem = cart.find(item => item.title === title);

            if (existingItem) {
                // Se já existe, aumenta a quantidade
                existingItem.quantity += 1;
            } else {
                // Se não existe, adiciona ao carrinho
                cart.push({
                    title: title,
                    price: price,
                    image: image,
                    quantity: 1
                });
            }

            // Atualiza o carrinho
            updateCart();

            // Feedback visual
            alert('Produto adicionado ao carrinho!');
        }

        // Função para remover produto do carrinho
        function removeFromCart(index) {
            cart.splice(index, 1);
            updateCart();
        }

        // Função para atualizar a exibição do carrinho
        function updateCart() {
            verifyEmptyButton()
            const cartCount = document.getElementById('cart-count');
            const cartItems = document.getElementById('cart-items');
            const cartTotal = document.getElementById('cart-total');

            // Atualiza o contador
            const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
            cartCount.textContent = totalItems;

            // Atualiza os itens do carrinho
            if (cart.length === 0) {
                cartItems.innerHTML = '<div class="text-gray-500 text-center py-4">Seu carrinho está vazio</div>';
            } else {
                cartItems.innerHTML = '';

                cart.forEach((item, index) => {
                    const itemElement = document.createElement('div');
                    itemElement.className = 'flex items-center justify-between py-3 border-b';
                    itemElement.innerHTML = `
                        <div class="flex items-center">
                            <img src="${item.image}" alt="${item.title}" class="w-12 h-12 object-cover rounded-md">
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900">${item.title}</div>
                                <div class="text-sm text-gray-500">R$ ${item.price.toFixed(2)} x ${item.quantity}</div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <button onclick="removeFromCart(${index})" class="text-gray-500 hover:text-red-500">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    `;
                    cartItems.appendChild(itemElement);
                });
            }

            // Atualiza o total
            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            cartTotal.textContent = `R$ ${total.toFixed(2)}`;

            // Salva o carrinho no localStorage
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        // Função para finalizar o pedido
        function checkout() {
            if (cart.length === 0) {
                alert('Seu carrinho está vazio!');
                return;
            }

            // Prepara a mensagem para o WhatsApp
            let message = 'Olá! Gostaria de fazer o seguinte pedido:\n\n';

            cart.forEach(item => {
                message += `${item.quantity}x ${item.title} - R$ ${(item.price * item.quantity).toFixed(2)}\n`;
            });

            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            message += `\nTotal: R$ ${total.toFixed(2)}`;

            // Codifica a mensagem para URL
            const encodedMessage = encodeURIComponent(message);

            // Abre o WhatsApp com a mensagem
            window.open(`https://wa.me/31994409981?text=${encodedMessage}`, '_blank');

            // Limpa o carrinho após finalizar o pedido
            clearCart()
        }

        // Funções para abrir e fechar o modal do carrinho
        function openCartModal() {
            document.getElementById('cart-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Impede rolagem da página
            verifyEmptyButton()
        }

        function verifyEmptyButton() {
            if (cart.length !== 0) {
                clearCartButton.innerHTML = `
                <button id="empty-cart-button" onclick="clearCart()"
                        class="w-full bg-red-500 text-white py-3 rounded-md hover:bg-red-600 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-trash-alt mr-2"></i> Esvaziar Carrinho
                    </button>
                `;
            } else {
                clearCartButton.innerHTML = '';
            }
        }

        function closeCartModal() {
            document.getElementById('cart-modal').classList.add('hidden');
            document.body.style.overflow = 'auto'; // Permite rolagem da página
        }

        // Carrega o carrinho do localStorage ao iniciar a página
        document.addEventListener('DOMContentLoaded', function () {
            const savedCart = localStorage.getItem('cart');
            if (savedCart) {
                cart = JSON.parse(savedCart);
                updateCart();
            }

            // Adiciona os event listeners
            document.getElementById('cart-button').addEventListener('click', openCartModal);
            document.getElementById('close-cart').addEventListener('click', closeCartModal);

            // Fecha o modal ao clicar fora dele
            document.getElementById('cart-modal').addEventListener('click', function (event) {
                if (event.target === this) {
                    closeCartModal();
                }
            });
        });
    </script>
</body>

</html>