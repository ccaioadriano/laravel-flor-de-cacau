<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Meta tags principais para SEO -->
    <title>Flor de Cacau - Doces Artesanais em Belo Horizonte | Brigadeiros e Bolos</title>
    <meta name="description"
        content="Descubra os deliciosos doces artesanais da Flor de Cacau em Belo Horizonte. Brigadeiros, bolos e sobremesas feitos com ingredientes selecionados e muito amor.">
    <meta name="keywords"
        content="doces artesanais, brigadeiros, bolos, sobremesas, Belo Horizonte, chocolate artesanal, confeitaria">
    <meta name="author" content="Flor de Cacau">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.flordecacau.com/">
    <meta property="og:title" content="Flor de Cacau - Doces Artesanais em Belo Horizonte">
    <meta property="og:description"
        content="Descubra os deliciosos doces artesanais da Flor de Cacau. Brigadeiros, bolos e sobremesas feitos com ingredientes selecionados.">
    <meta property="og:image" content="https://www.flordecacau.com/images/og-image.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://www.flordecacau.com/">
    <meta property="twitter:title" content="Flor de Cacau - Doces Artesanais em Belo Horizonte">
    <meta property="twitter:description"
        content="Descubra os deliciosos doces artesanais da Flor de Cacau. Brigadeiros, bolos e sobremesas feitos com ingredientes selecionados.">
    <meta property="twitter:image" content="https://www.flordecacau.com/images/twitter-image.jpg">

    @yield('meta')

    <!-- Canonical URL -->
    <link rel="canonical" href="https://www.flordecacau.com/">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

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

    <!-- Schema.org markup para negócio local -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "Flor de Cacau",
        "image": "https://www.flordecacau.com/images/logo.jpg",
        "description": "Doces artesanais feitos com amor e dedicação em Belo Horizonte",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Endereço da Flor de Cacau",
            "addressLocality": "Belo Horizonte",
            "addressRegion": "MG",
            "postalCode": "00000-000",
            "addressCountry": "BR"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "-19.917699",
            "longitude": "-43.934738"
        },
        "url": "https://www.flordecacau.com",
        "telephone": "+55-31-99561-9393",
        "openingHoursSpecification": [
            {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                "opens": "09:00",
                "closes": "18:00"
            }
        ],
        "priceRange": "$$"
    }
    </script>
</head>

<body class="bg-gray-50">
    <!-- Cabeçalho -->
    <header class="bg-[#143151] shadow-lg">
        <nav class="container mx-auto px-6 py-4" aria-label="Navegação principal">
            <div class="flex items-center justify-between">
                <div class="text-2xl font-bold text-white">
                    <a href="/" aria-label="Flor de Cacau - Página inicial">
                        <h1>Flor de Cacau</h1>
                    </a>
                </div>
                <div class="flex items-center space-x-8">
                    <div class="flex items-center space-x-8">
                        <a href="/" class="text-white hover:text-gray-200 transition-custom"
                            aria-current="page">Início</a>
                        <a href="{{ route('about') }}"
                            class="text-white hover:text-gray-200 transition-custom">Sobre</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main id="conteudo-principal">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#143151] text-white py-8 mt-10">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <section>
                    <h2 class="text-xl font-semibold mb-4">Flor de Cacau</h2>
                    <p class="text-gray-300">Doces artesanais feitos com amor e dedicação</p>
                </section>
                <section>
                    <h2 class="text-xl font-semibold mb-4">Contato</h2>
                    <address class="not-italic">
                        <p class="text-gray-300">
                            <a href="https://wa.me/5531995619393" class="hover:text-white transition-custom">
                                WhatsApp: +55 (31) 99561-9393
                            </a>
                        </p>
                        <p class="text-gray-300">
                            <a href="mailto:contato@flordecacau.com" class="hover:text-white transition-custom">
                                Email: contato@flordecacau.com
                            </a>
                        </p>
                    </address>
                </section>
                <section>
                    <h2 class="text-xl font-semibold mb-4">Horário de Funcionamento</h2>
                    <p class="text-gray-300">Segunda a Sábado</p>
                    <time class="text-gray-300">09:00 - 18:00</time>
                </section>
            </div>
            <div class="text-center mt-8 pt-8 border-t border-gray-700">
                <p class="flex justify-center items-center gap-4">
                    <span>&copy; <time datetime="2025">2025</time> Flor de Cacau. Todos os direitos reservados.</span>
                    <a href="{{ route('login')}}"
                        class="text-gray-400 hover:text-white text-sm transition-custom flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Área Administrativa
                    </a>
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    @stack('script')
</body>

</html>