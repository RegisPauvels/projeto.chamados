<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bem vindo ao sistema de administrador!
        </h2>
    </x-slot>

   
<div class="flex min-h-screen">
   
    <div class="bg-gray-50 w-64 border-r border-gray-200 p-4">
        <ul class="space-y-2 p-4">
            <li>
                <a href="{{ route('equipes.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                    <span class="ml-3">Gerenciar Equipes</span>
                </a>
            </li>
            <li>
                <a href="{{ route('analistas.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>
                    <span class="ml-3">Gerenciar Analistas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('categorias.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                    <span class="ml-3">Gerenciar Categorias</span>
                </a>
            </li>
            <li>
                <a href="{{ route('relatorios.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />
                    </svg>
                    <span class="ml-3">Relatorios</span>
                </a>
            </li>
        </ul>
    </div>

    
    <div class="flex-1">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                           
                            <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-700">Chamados em Aberto</h3>
                                <p class="mt-4 text-3xl font-bold text-blue-600">{{$chamadosAbertos}}</p>
                            </div>

                            
                            <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-700">Chamados Encerrados</h3>
                                <p class="mt-4 text-3xl font-bold text-green-600">{{$chamadosEncerrados}}</p>
                            </div>

                            <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-700">Todos os chamados</h3>
                                <p class="mt-4 text-3xl font-bold text-yellow-600">{{$todosChamados}}</p>
                            </div>
                        </div>

                        
                        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Chamados Encerrados por Mês</h3>
                         <div class="relative w-full h-64">
                            <canvas id="graficoChamados"></canvas>
                            </div>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            const ctx = document.getElementById('graficoChamados').getContext('2d');

                            const chart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: @json($ticketLabels),
                                    datasets: [{
                                        label: 'Chamados por mês',
                                        data: @json($ticketData),
                                        backgroundColor: 'rgba(59, 130, 246, 0.2)', 
                                        borderColor: 'rgba(59, 130, 246, 1)',
                                        borderWidth: 2,
                                        fill: true,
                                        tension: 0.3
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            precision: 0
                                        }
                                    }
                                }
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>