@extends('layouts.main')
@section('content')
    <div class="container mx-auto px-6 py-8 min-h-[780px]" x-data="docesCategorias()">
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
                            <input type="text" placeholder="Buscar doces..."
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Lista de Doces -->
                        <div class="h-96 overflow-y-auto p-4">

                            @foreach ($products as $product)
                                <!-- Cada doce terá um dropdown para selecionar a categoria -->
                                <div class="flex items-center justify-between p-3 hover:bg-gray-50 border-b">
                                    <span class="text-gray-700">{{ $product->title }}</span>
                                    <select
                                        class="border rounded-lg px-3 py-1 text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                        onchange="linkProductToCategory({{$product->id}}, this.value)">
                                        <option value="">Selecione...</option>

                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">
                                                {{$category->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-700 mb-4">Categorias</h3>
                    <div class="space-y-4">
                        <!-- Categoria Frutas -->
                        @foreach ($categories as $category)
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-medium text-gray-800">{{$category->name}}</h4>
                                    <span
                                        class="text-sm text-gray-500">{{ $category->getCountProducts() == 1 ? $category->getCountProducts() . " Doce" : $category->getCountProducts() . " Doces" }}</span>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($category->products as $product)
                                            <span
                                                class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm flex items-center">
                                                <span class="mr-2">{{$product->title}}</span>
                                                <button class="ml-2 text-blue-600 hover:text-blue-800"
                                                    onclick="unlikeProduct({{$product->id}})">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Botão de Salvar -->
        <div class="flex justify-end">
            <button
                class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                disabled>
                Salvar Alterações
            </button>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function unlikeProduct(id) {
            $.ajax({
                url: "/unlike-product/" + id,
                type: "PUT",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    console.log(response);
                    window.location.reload();
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    alert("Erro ao desassociar o produto.");
                }
            });
        }

        function linkProductToCategory(product_id, category_id) {

            $.ajax({
                url: "/link-product-to-category/" + product_id,
                type: "PUT",
                data: {
                    id: product_id,
                    category_id: category_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    window.location.reload();
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    alert("Erro ao vincular o produto à categoria.");
                }
            });
        }
    </script>
@endpush