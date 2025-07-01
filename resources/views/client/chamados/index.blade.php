<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Todos os chamados
        </h2>
    </x-slot>


    <div class="">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-medium text-gray-900">Todos os chamados em meu nome:</h3>
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>