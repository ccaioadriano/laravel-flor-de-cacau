@extends('layouts.main')
@section('content')
    <div class="container mx-auto px-6 py-8 min-h-[780px]" x-data="{
                                                    search: '',
                                                    products: {{ Js::from($products) }},
                                                    categories: {{ Js::from($categories) }},
                                                    loading: false,

                                                    async filterProducts() {
                                                        this.loading = true;
                                                        try {
                                                            const response = await fetch(`/dashboard/search?search=${this.search}`);
                                                            const data = await response.json();
                                                            this.products = data;
                                                        } catch (error) {
                                                            console.error('Erro:', error);
                                                        }
                                                        this.loading = false;
                                                    },

                                                    async linkProductToCategory(productId, categoryId) {
                                                        try {
                                                            const response = await fetch(`/link-product-to-category/${productId}`, {
                                                                method: 'PUT',
                                                                headers: {
                                                                    'Content-Type': 'application/json',
                                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                                },
                                                                body: JSON.stringify({
                                                                    category_id: categoryId
                                                                })
                                                            });

                                                            if (response.ok) {
                                                            window.location.reload();
                                                            }
                                                        } catch (error) {
                                                            console.error('Erro:', error);
                                                            alert('Erro ao vincular produto à categoria');
                                                        }
                                                    },

                                                    async unlinkProduct(productId) {
                                                        try {
                                                            const response = await fetch(`/unlink-product/${productId}`, {
                                                                method: 'PUT',
                                                                headers: {
                                                                    'Content-Type': 'application/json',
                                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                                }
                                                            });

                                                            if (response.ok) {
                                                                window.location.reload();
                                                            }
                                                        } catch (error) {
                                                            console.error('Erro:', error);
                                                            alert('Erro ao desvincular produto');
                                                        }
                                                    }
                                                }">
        <h1 class="text-3xl font-semibold text-gray-800 mb-8">Painel Administrativo</h1>

        <!-- Seção de Vinculação de Doces às Categorias -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Vincular Doces às Categorias</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Lista de Doces -->
                <div>
                    <h3 class="text-lg font-medium text-gray-700 mb-4">Doces Disponíveis</h3>
                    <div class="border rounded-lg">
                        <!-- Campo de busca -->
                        <div class="p-4 border-b bg-gray-50">
                            <input type="text" placeholder="Buscar doces..." x-model="search"
                                @input.debounce.300ms="filterProducts()"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Loading indicator -->
                        <div x-show="loading" class="p-4 text-center">
                            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500 mx-auto"></div>
                        </div>

                        <div x-show="products.length === 0" class="p-4 text-center">
                            <p class="text-gray-500">Nenhum doce encontrado.</p>
                        </div>

                        <!-- Lista de Doces -->
                        <div class="h-96 overflow-y-auto p-4" id="products-container">
                            <template x-for="product in products" :key="product . id">
                                <div class="flex items-center justify-between p-3 hover:bg-gray-50 border-b">
                                    <span class="text-gray-700" x-text="product.title"></span>
                                    <select
                                        class="border rounded-lg px-3 py-1 text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                        @change="linkProductToCategory(product.id, $event.target.value)">
                                        <option value="">Selecione...</option>
                                        <template x-for="category in categories" :key="category . id">
                                            <option :value="category . id" x-text="category.name"></option>
                                        </template>
                                    </select>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Categorias -->
                <div>
                    <h3 class="text-lg font-medium text-gray-700 mb-4">Categorias</h3>
                    <div class="space-y-4">
                        <template x-for=" category in categories" :key="category . id">
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-medium text-gray-800" x-text="category.name"></h4>
                                    <span class="text-sm text-gray-500"
                                        x-text="category.products.length + (category.products.length === 1 ? ' Doce' : ' Doces')">
                                    </span>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <div class="flex flex-wrap gap-2">
                                        <template x-for="product in category.products" :key="product . id">
                                            <span
                                                class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm flex items-center">
                                                <span class="mr-2" x-text="product.title"></span>
                                                <button class="ml-2 text-blue-600 hover:text-blue-800"
                                                    @click="unlinkProduct(product.id)">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </span>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection