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
                    <div class="flex items-center space-x-8">
                        <a href="/" class="text-white hover:text-gray-200 transition-custom">Início</a>
                        <a href="{{ route('about') }}"
                            class="text-white hover:text-gray-200 transition-custom">Sobre</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

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

    <script src="{{ asset('js/utils.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    @stack('script')
</body>

</html>