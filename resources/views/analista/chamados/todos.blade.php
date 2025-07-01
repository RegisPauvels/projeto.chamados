<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Todos os chamados: </h2>
    </x-slot>

    <div class="py-6 container mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
            <form method="GET" action="{{ route('analista.chamados.todos') }}">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Período</label>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="date" name="start_date" value="{{ $filters['start_date'] }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                            <input type="date" name="end_date" value="{{ $filters['end_date'] }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Analista</label>
                        <select name="analyst_id" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                            <option value="">Todos</option>
                            @foreach($filterData['analysts'] as $analyst)
                                <option value="{{ $analyst->id }}" {{ $filters['analyst_id'] == $analyst->id ? 'selected' : '' }}>
                                    {{ $analyst->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Departamento</label>
                        <select name="department_id" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                            <option value="">Todos</option>
                            @foreach($filterData['departments'] as $department)
                                <option value="{{ $department->id }}" {{ $filters['department_id'] == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
                        <select name="category_id" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                            <option value="">Todos</option>
                            @foreach($filterData['categories'] as $category)
                                <option value="{{ $category->id }}" {{ $filters['category_id'] == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nível de Urgência</label>
                        <select name="urgency_level_id" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                            <option value="">Todos</option>
                            @foreach($filterData['urgencyLevels'] as $urgency)
                                <option value="{{ $urgency->id }}" {{ $filters['urgency_level_id'] == $urgency->id ? 'selected' : '' }}>
                                    {{ $urgency->name }} ({{ $urgency->level }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                            <option value="">Todos</option>
                            @foreach($filterData['statuses'] as $key => $status)
                                <option value="{{ $key }}" {{ $filters['status'] == $key ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4 flex justify-end space-x-2">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm">
                        Filtrar
                    </button>
                    <a href="{{ route('relatorios.chamados') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 text-sm">
                        Limpar Filtros
                    </a>
                </div>
            </form>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b">
                <div>
                    <p class="text-sm text-gray-600">
                        Mostrando {{ $tickets->firstItem() }} - {{ $tickets->lastItem() }} de {{ $tickets->total() }} registros
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Título</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cliente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Analista</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Departamento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Urgência</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($tickets as $ticket)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $ticket->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <a href="#" class="text-blue-600 hover:text-blue-900">
                                    {{ Str::limit($ticket->title, 30) }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $ticket->client->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $ticket->analyst->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $ticket->department->name ?? 'N/A' }}
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $ticket->urgency->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $ticket->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('analista.chamados.show', $ticket->id) }}" class="text-green-600 hover:text-green-900 mr-3">Acessar</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                Nenhum chamado encontrado com os filtros aplicados
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
</x-app-layout>