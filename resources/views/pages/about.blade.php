@extends('layouts.main')

@section('meta')
    <!-- Meta tags específicas para a página Sobre -->
    <title>Sobre a Flor de Cacau - Nossa História e Valores | Confeitaria Artesanal em BH</title>
    <meta name="description"
        content="Conheça a história da Flor de Cacau BH, confeitaria artesanal especializada em doces especiais. Descubra nossos valores, paixão pela confeitaria e compromisso com a qualidade.">
    <meta name="keywords"
        content="confeitaria artesanal BH, história Flor de Cacau, doces artesanais Belo Horizonte, confeitaria premium BH">

    <!-- Open Graph tags específicas -->
    <meta property="og:title" content="Sobre a Flor de Cacau - Confeitaria Artesanal em BH">
    <meta property="og:description"
        content="Conheça nossa história de paixão pela confeitaria artesanal e compromisso com a qualidade em cada doce que preparamos.">
    <meta property="og:type" content="article">
    <meta property="article:section" content="Sobre">

    <!-- Schema.org markup específico para a página -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Article",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "https://www.flordecacau.com/sobre"
            },
            "headline": "História e Valores da Flor de Cacau",
            "description": "A Flor de Cacau BH nasceu da paixão por transformar momentos em memórias doces, especializada em confeitaria artesanal.",
            "image": "https://www.flordecacau.com/images/sobre-flor-cacau.jpg",
            "author": {
                "@type": "Organization",
                "name": "Flor de Cacau"
            },
            "publisher": {
                "@type": "Organization",
                "name": "Flor de Cacau",
                "logo": {
                    "@type": "ImageObject",
                    "url": "https://www.flordecacau.com/images/logo.jpg"
                }
            },
            "datePublished": "2025-01-01",
            "dateModified": "2025-04-22"
        }
        </script>
@endsection

@section('content')
    <div class="container mx-auto px-4 py-12">
        <!-- Breadcrumb para SEO -->
        <nav aria-label="Breadcrumb" class="mb-6">
            <ol class="flex text-sm text-gray-600">
                <li><a href="/" class="hover:text-[#143151]">Início</a></li>
                <li><span class="mx-2">/</span></li>
                <li aria-current="page" class="text-[#143151]">Sobre</li>
            </ol>
        </nav>

        <!-- Seção Hero -->
        <section class="text-center mb-12">
            <h1 class="text-4xl font-bold text-[#143151] mb-4">Nossa História</h1>
            <div class="w-24 h-1 bg-[#143151] mx-auto mb-8" role="presentation"></div>
        </section>

        <!-- Conteúdo Principal -->
        <article class="max-w-3xl mx-auto">
            <div class="bg-white/90 rounded-lg shadow-lg p-8 mb-12">
                <div class="space-y-6">
                    <p class="text-lg leading-relaxed text-gray-700">
                        A Flor de Cacau BH nasceu da paixão por transformar momentos em memórias doces. Especializada em
                        confeitaria artesanal, nossa missão é encantar paladares e corações com receitas que unem tradição,
                        criatividade
                        e ingredientes selecionados.
                    </p>

                    <p class="text-lg leading-relaxed text-gray-700">
                        Cada doce é preparado com carinho, cuidado e aquele toque especial que só quem ama o que faz
                        consegue colocar em cada detalhe.
                    </p>
                </div>
            </div>

            <!-- Cards de Valores -->
            <section aria-labelledby="nossos-valores" class="grid md:grid-cols-3 gap-8 mt-12">
                <h2 id="nossos-valores" class="sr-only">Nossos Valores</h2>

                <!-- Card 1 -->
                <article
                    class="bg-white rounded-lg shadow-lg p-6 text-center transform transition-all duration-300 hover:scale-105">
                    <div class="text-[#143151] text-4xl mb-4" aria-hidden="true">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-[#143151]">Amor</h3>
                    <p class="text-gray-600">Dedicação em cada preparo</p>
                </article>

                <!-- Card 2 -->
                <article
                    class="bg-white rounded-lg shadow-lg p-6 text-center transform transition-all duration-300 hover:scale-105">
                    <div class="text-[#143151] text-4xl mb-4" aria-hidden="true">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-[#143151]">Qualidade</h3>
                    <p class="text-gray-600">Ingredientes selecionados</p>
                </article>

                <!-- Card 3 -->
                <article
                    class="bg-white rounded-lg shadow-lg p-6 text-center transform transition-all duration-300 hover:scale-105">
                    <div class="text-[#143151] text-4xl mb-4" aria-hidden="true">
                        <i class="fas fa-magic"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-[#143151]">Criatividade</h3>
                    <p class="text-gray-600">Receitas exclusivas</p>
                </article>
            </section>
        </article>

        <!-- Seção de Contato Rápido -->
        <section class="text-center mt-16">
            <h2 class="text-2xl font-semibold mb-4 text-[#143151]">Quer experimentar nossas delícias?</h2>
            <a href="/contato"
                class="inline-block bg-[#143151] text-white px-8 py-3 rounded-full hover:bg-[#0f243c] transition-colors duration-300 transform hover:scale-105"
                rel="nofollow" aria-label="Clique para entrar em contato conosco">
                Entre em Contato
            </a>
        </section>
    </div>
@endsection

@push('script')
    <!-- Microdata estruturado adicional -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "FAQPage",
            "mainEntity": [{
                "@type": "Question",
                "name": "O que é a Flor de Cacau?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "A Flor de Cacau é uma confeitaria artesanal especializada em doces especiais, localizada em Belo Horizonte. Nosso foco é criar experiências únicas através de receitas exclusivas e ingredientes selecionados."
                }
            }]
        }
        </script>
@endpush