@extends('layouts.main')

@section('content')
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

        <div class="mb-8 flex justify-center">
            <div class="inline-flex rounded-md shadow-sm" role="group">
                <a href="{{ route('home', ['category' => 'all']) }}"
                    class="filter-btn px-4 py-2 text-sm font-medium {{ (request()->category === 'all') || !request()->category ? 'bg-[#143151] text-white' : 'bg-gray-200 text-gray-700  hover:bg-gray-300' }} rounded">
                    Todos
                </a>

                <a href="{{ route('home', ['category' => 'brigadeiros']) }}"
                    class="filter-btn px-4 py-2 text-sm font-medium {{ (request()->category === 'brigadeiros') ? 'bg-[#143151] text-white' : 'bg-gray-200 text-gray-700  hover:bg-gray-300' }} rounded">
                    Brigadeiros
                </a>
                <a href="{{ route('home', ['category' => 'bolos']) }}"
                    class="filter-btn px-4 py-2 text-sm font-medium {{ (request()->category === 'bolos') ? 'bg-[#143151] text-white' : 'bg-gray-200 text-gray-700  hover:bg-gray-300' }} rounded">
                    Bolos
                </a>
                <a href="{{ route('home', ['category' => 'trufas']) }}"
                    class="filter-btn px-4 py-2 text-sm font-medium {{ (request()->category === 'trufas') ? 'bg-[#143151] text-white' : 'bg-gray-200 text-gray-700  hover:bg-gray-300' }} rounded">
                    Trufas
                </a>
            </div>
        </div>

        <!-- Produtos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($products as $product)
                <article
                    class="product-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <!-- Menu de Opções (três pontos) -->
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-semibold text-[#143151]">{{ $product->title }}</h3>
                            @auth
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="text-[#143151] hover:bg-gray-100 rounded-full p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                        </svg>
                                    </button>
                                    <!-- Menu Dropdown -->
                                    <div x-show="open" @click.away="open = false"
                                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100">
                                        <div class="py-1">
                                            <button onclick="openEditImageModal('{{ $product->id }}')"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-image mr-2"></i> Alterar Imagem
                                            </button>
                                            <button onclick="openPriceModal('{{ $product->id }}')"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-tag mr-2"></i> Alterar Preço
                                            </button>
                                            <form action="{{ route('deleteProduct', [$product->id]) }}" method="POST" class="block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Tem certeza que deseja excluir este doce?')"
                                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                                    <i class="fas fa-trash-alt mr-2"></i> Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endauth
                        </div>

                        <img src="{{ $product->image ? asset('storage/images/' . $product->image) : asset('img/default.png') }}"
                            alt="{{ $product->title }}" class="w-full h-48 object-cover mb-4 rounded-md">

                        <p class="text-[#143151] font-bold mt-4">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </p>

                        <p class="text-gray-600 mt-2">
                            {{ $product->description }}
                        </p>

                        <div class="flex items-center mt-4 mb-2">
                            <label for="qty-{{ $product->id }}" class="mr-2 text-[#143151] font-medium">Quantidade:</label>
                            <input id="qty-{{ $product->id }}" type="number" min="1" value="1"
                                class="w-20 border border-gray-300 rounded px-2 py-1 text-center focus:outline-none focus:ring-2 focus:ring-[#143151]">
                        </div>

                        <button
                            onclick="addToCart('{{ $product->title }}', {{ $product->price}}, '{{ $product->image ? asset('storage/images/' . $product->image) : asset('img/default.png') }}', document.getElementById('qty-{{ $product->id }}').value)"
                            class="mt-2 bg-[#143151] text-white px-4 py-2 rounded-md hover:bg-[#0c1f33] transition-all duration-300 w-full">
                            Adicionar ao carrinho
                        </button>
                    </div>
                </article>
                <!-- Modal de Edição de Imagem -->
                <div id="imageModal-{{ $product->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
                    <div class="flex items-center justify-center min-h-screen px-4">
                        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-[#143151] mb-4">Alterar Imagem</h3>
                                <form action="{{ route('updateImage', [$product->id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nova Imagem</label>
                                        <input type="file" name="image" accept="image/*" required
                                            class="w-full border border-gray-300 rounded px-3 py-2">
                                    </div>
                                    <div class="flex justify-end gap-2">
                                        <button type="button" onclick="closeModal('imageModal-{{ $product->id }}')"
                                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                                            Cancelar
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-[#143151] text-white rounded hover:bg-[#0c1f33]">
                                            Salvar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal de Edição de Preço -->
                <div id="priceModal-{{ $product->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
                    <div class="flex items-center justify-center min-h-screen px-4">
                        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-[#143151] mb-4">Alterar Preço</h3>
                                <form action="{{ route('updatePrice', [$product->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Novo Preço (R$)</label>
                                        <input name="price" id="price-{{ $product->id }}" value="{{ $product->price}}" required
                                            class="w-full border border-gray-300 rounded px-3 py-2">
                                    </div>
                                    <div class="flex justify-end gap-2">
                                        <button type="button" onclick="closeModal('priceModal-{{ $product->id }}')"
                                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                                            Cancelar
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-[#143151] text-white rounded hover:bg-[#0c1f33]">
                                            Salvar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <p class="text-gray-500">Nenhum produto encontrado.</p>
            @endforelse
        </div>
        <!-- Paginação -->
        <div class="mt-12">
            {{ $products->withQueryString()->links() }}
        </div>
    </section>

    <!-- Botão flutuante do WhatsApp -->
    <button onclick="Utils.sendMessageWhatsapp(null,'{{ config('contact.phone_clean') }}')" target="_blank"
        class="fixed bottom-[10%] right-6 bg-green-500 text-white w-14 h-14 flex items-center justify-center rounded-full shadow-lg hover:bg-green-600 hover:scale-110 transition-all duration-300 z-50">
        <i class="fab fa-whatsapp text-3xl"></i>
    </button>

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
@endsection

@push('script')
    <script>
        window.config = {
            phoneClean: "{{ config('contact.phone_clean') }}"
        }
    </script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src={{ asset('plugins/jquery.maskMoney.js') }} type="text/javascript"></script>
    <script src="{{ asset('js/utils.js') }}" defer></script>
    <script src="{{ asset('js/scripts.js') }}" defer></script>
@endpush