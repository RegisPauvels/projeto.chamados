<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chama o TI - Sistema de Chamados</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Cabeçalho -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center">
                <span class="text-xl font-bold text-gray-800">Chama o TI</span>
            </div>
             @if (Route::has('login'))
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="fbg-blue-600 hover:bg-blue-700 text-black hover:text-white px-4 py-2 rounded-md text-sm font-medium">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700  text-black hover:text-white px-4 py-2 rounded-md text-sm font-medium">Cadastre-se</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </header>

   
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-32 w-32 rounded-full bg-blue-100 mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                </svg>
            </div>
            
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Bem vindo ao sistema Chama o TI</h1>
            <p class="text-xl text-gray-600">Faça login para acessar o sistema</p>
            
                @if (Route::has('login'))
                <div class="mt-8 flex justify-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200">Cadastre-se</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </main>

 
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
            <p class="text-center text-gray-500 text-sm">&copy; 2025 Chama o TI. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>