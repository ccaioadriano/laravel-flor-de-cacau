@extends('layouts.main')
@section('content')
    <div class="flex items-center justify-center min-h-[680px] px-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-[#143151] mb-6">Criar Novo Produto</h3>

                <form action="{{ route('store_product') }}" method="POST">
                    @csrf

                    <!-- Nome do Produto -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nome do Produto</label>
                        <input type="text" name="title" id="title" required placeholder="Digite o nome do produto" value="{{ old('title') }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#143151] focus:border-[#143151]">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descrição -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                        <textarea name="description" id="description" rows="4" placeholder="Digite a descrição do produto" 
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#143151] focus:border-[#143151]">
                            {{ old('description') }}
                        </textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Imagem -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Imagem</label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#143151] focus:border-[#143151]">
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Preço -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preço (R$)</label>

                        <input type="text" name="price" id="price" required placeholder="0,00"
                            onfocus="Utils.applyMaskMoney(this)" 
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#143151] focus:border-[#143151]">

                        @error('price')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botões -->
                    <div class="flex justify-end gap-2">
                        <a href="{{--  --}}"
                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 transition-colors duration-200">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-[#143151] text-white rounded hover:bg-[#0c1f33] transition-colors duration-200">
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src={{ asset('plugins/jquery.maskMoney.js') }} type="text/javascript"></script>
    <script src="{{ asset('js/utils.js') }}" defer></script>
@endpush