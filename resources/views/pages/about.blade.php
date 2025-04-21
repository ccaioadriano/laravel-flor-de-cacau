@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <!-- Seção Hero -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-[#143151] mb-4">Nossa História</h1>
            <div class="w-24 h-1 bg-[#143151] mx-auto mb-8"></div>
        </div>

        <!-- Conteúdo Principal -->
        <div class="max-w-3xl mx-auto">
            <div class="bg-white/90 rounded-lg shadow-lg p-8 mb-12">
                <div class="space-y-6">
                    <p class="text-lg leading-relaxed text-gray-700">
                        A Flor de Cacau BH nasceu da paixão por transformar momentos em memórias doces. Especializada em
                        confeitaria
                        artesanal, nossa missão é encantar paladares e corações com receitas que unem tradição, criatividade
                        e ingredientes
                        selecionados.
                    </p>

                    <p class="text-lg leading-relaxed text-gray-700">
                        Cada doce é preparado com carinho, cuidado e aquele toque especial que só quem ama o que faz
                        consegue
                        colocar em cada detalhe.
                    </p>
                </div>
            </div>

            <!-- Cards de Valores -->
            <div class="grid md:grid-cols-3 gap-8 mt-12">
                <!-- Card 1 -->
                <div
                    class="bg-white rounded-lg shadow-lg p-6 text-center transform transition-all duration-300 hover:scale-105">
                    <div class="text-[#143151] text-4xl mb-4">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-[#143151]">Amor</h3>
                    <p class="text-gray-600">Dedicação em cada preparo</p>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-white rounded-lg shadow-lg p-6 text-center transform transition-all duration-300 hover:scale-105">
                    <div class="text-[#143151] text-4xl mb-4">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-[#143151]">Qualidade</h3>
                    <p class="text-gray-600">Ingredientes selecionados</p>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-white rounded-lg shadow-lg p-6 text-center transform transition-all duration-300 hover:scale-105">
                    <div class="text-[#143151] text-4xl mb-4">
                        <i class="fas fa-magic"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-[#143151]">Criatividade</h3>
                    <p class="text-gray-600">Receitas exclusivas</p>
                </div>
            </div>
        </div>

        <!-- Seção de Contato Rápido -->
        <div class="text-center mt-16">
            <h3 class="text-2xl font-semibold mb-4 text-[#143151]">Quer experimentar nossas delícias?</h3>
            <a href="/contato" class="inline-block bg-[#143151] text-white px-8 py-3 rounded-full 
                      hover:bg-[#0f243c] transition-colors duration-300 
                      transform hover:scale-105">
                Entre em Contato
            </a>
        </div>
    </div>
@endsection