<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Analistas</h2>
    </x-slot>

    <div class="py-6 container mx-auto">
        <div class="flex justify-between mb-4">
            <a href="{{ route('analistas.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                Novo Analista
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Departamento</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($analysts as $analyst)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $analyst->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $analyst->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $analyst->department->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('analistas.edit', $analyst->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Editar</a>
                            <a href="{{ route('analistas.show', $analyst->id) }}" class="text-yellow-600 hover:text-blue-900 mr-2">Visualizar</a>
                            <form action="{{ route('analistas.destroy', $analyst->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>