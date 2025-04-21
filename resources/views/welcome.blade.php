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
@endsection