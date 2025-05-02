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

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Jquery -->
    <script src="{{ asset('plugins/jquery-3.7.1.min.js') }}"></script>

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

<body class="bg-gray-50 h-screen flex flex-col">
    <header class="bg-[#143151] shadow-lg">
        <div class="container mx-auto">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="text-2xl font-bold text-white">
                    <a href="/" aria-label="Flor de Cacau - Página inicial">
                        <h1>Flor de Cacau</h1>
                    </a>
                </div>

                <button id="menuButton" class="md:hidden text-white focus:outline-none" aria-label="Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                </button>

                <!-- Menu de navegação -->
                <nav id="navMenu" class="hidden md:block" aria-label="Navegação principal">
                    <div class="md:flex items-center space-x-8">
                        <a href="/"
                            class="block md:inline-block text-white hover:text-gray-200 transition-custom py-2 md:py-0"
                            aria-current="page">Início</a>
                        <a href="{{ route('about') }}"
                            class="block md:inline-block text-white hover:text-gray-200 transition-custom py-2 md:py-0">Sobre</a>
                        @auth
                            <a href="{{ route('dashboard') }}"
                                class="block md:inline-block text-white hover:text-gray-200 transition-custom py-2 md:py-0">Administração</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="block md:inline-block text-white hover:text-gray-200 transition-custom py-2 md:py-0">
                                    Sair
                                </button>
                            </form>
                        @endauth
                    </div>
                </nav>
            </div>

            <div id="mobileMenu" class="hidden md:hidden bg-[#143151] pb-4 px-6">
                <a href="/" class="block text-white hover:text-gray-200 transition-custom py-2">Início</a>
                <a href="{{ route('about') }}"
                    class="block text-white hover:text-gray-200 transition-custom py-2">Sobre</a>
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="block md:inline-block text-white hover:text-gray-200 transition-custom py-2 md:py-0">Administração</a>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="text-white hover:text-gray-200 transition-custom py-2">
                            Sair
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </header>

    <main id="conteudo-principal">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#143151] text-white py-8 mt-10 flex-1">
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
                            <a href="https://wa.me/{{ config('contact.phone_clean') }}"
                                class="hover:text-white transition-custom">
                                WhatsApp: {{ config('contact.phone') }}
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
                    <a href="/login"
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
    <script>
        $(document).ready(function () {
            const menuButton = $('#menuButton');
            const mobileMenu = $('#mobileMenu');

            menuButton.on('click', function () {
            // Toggle do menu mobile
            if (mobileMenu.hasClass('hidden')) {
                mobileMenu.removeClass('hidden');
                menuButton.html(`
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                `);
            } else {
                mobileMenu.addClass('hidden');
                menuButton.html(`
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                `);
            }
            });

            $(window).on('resize', function () {
            if ($(window).width() >= 768) { // 768px é o breakpoint md do Tailwind
                mobileMenu.addClass('hidden');
                menuButton.html(`
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                `);
            }
            });
        });
    </script>
</body>

</html>