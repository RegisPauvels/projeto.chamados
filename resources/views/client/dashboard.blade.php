<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bem vindo ao sistema de chamados!
        </h2>
    </x-slot>


    <div class="sidebar bg-gray-50 fixed h-full w-64 border-r border-gray-200 ">
        <ul class="space-y-2 p-4">
            <li>
                <a href="{{ route('solicitacao.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-gray-500 mr-3">
                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-3">Nova Solicitação</span>
                </a>
            </li>
            <li>
                <a href="{{ route('chamados.create') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-gray-500 mr-3">
                        <path d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                    </svg>
                    <span class="ml-3">Tenho um Problema</span>
                </a>
            </li>
            <li>
                <a href="{{ route('chamados.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-gray-500 mr-3">
                        <path fill-rule="evenodd" d="M1.5 6.375c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v3.026a.75.75 0 01-.375.65 2.249 2.249 0 000 3.898.75.75 0 01.375.65v3.026c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 17.625v-3.026a.75.75 0 01.374-.65 2.249 2.249 0 000-3.898.75.75 0 01-.374-.65V6.375zm15-1.125a.75.75 0 01.75.75v.75a.75.75 0 01-1.5 0V6a.75.75 0 01.75-.75zm.75 4.5a.75.75 0 00-1.5 0v.75a.75.75 0 001.5 0v-.75zm-.75 3a.75.75 0 01.75.75v.75a.75.75 0 01-1.5 0v-.75a.75.75 0 01.75-.75zm.75 4.5a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-.75zM6 12a.75.75 0 01.75-.75H12a.75.75 0 010 1.5H6.75A.75.75 0 016 12zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-3">Meus Chamados</span>
                </a>
            </li>
        </ul>
    </div>

  
    <div class="ml-64">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-medium text-gray-900">Meus Últimos Chamados</h3>
                            <a href="{{ route('chamados.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Novo Chamado
                            </a>
                        </div>

                        @if($tickets->isEmpty())
                            <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-blue-700">
                                            Você ainda não abriu nenhum chamado. 
                                            <a href="{{ route('chamados.create') }}" class="font-medium text-blue-700 hover:text-blue-600 underline">
                                                Clique aqui para criar seu primeiro chamado.
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="overflow-x-auto rounded-lg shadow">
                                <table class="min-w-full divide-y divide-gray-200 bg-white">
                                    <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                                        <tr>
                                            <th class="px-6 py-3 text-left">Número</th>
                                            <th class="px-6 py-3 text-left">Título</th>
                                            <th class="px-6 py-3 text-left">Departamento</th>
                                            <th class="px-6 py-3 text-left">Data</th>
                                            <th class="px-6 py-3 text-left">Status</th>
                                            <th class="px-6 py-3 text-left">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($tickets as $ticket)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $ticket->id }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                <a href="" class="text-blue-600 hover:text-blue-900">
                                                    {{ Str::limit($ticket->title, 40) }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $ticket->department->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $ticket->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs rounded-full 
                                                    {{ $ticket->status == 'open' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                    {{ $ticket->status == 'resolved' || $ticket->status == 'closed' ? 'bg-green-100 text-green-800' : '' }}
                                                    {{ $ticket->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                                    {{ in_array($ticket->status, ['assigned', 'in_progress', 'on_hold']) ? 'bg-blue-100 text-blue-800' : '' }}">
                                                    {{ $ticket->status_text }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('chamados.show', $ticket->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Ver</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            
                            <div class="mt-4 text-right">
                                <a href="{{ route('chamados.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                    Ver todos os meus chamados →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>