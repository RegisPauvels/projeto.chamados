<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Equipes</h2>
    </x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="py-6 px-8">
                @if (session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                <a href="{{ route('equipes.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Nova Equipe
                </a>

                <table class="min-w-full bg-white border rounded">
                    <thead>
                        <tr class="bg-gray-100 text-left text-sm uppercase">
                            <th class="px-4 py-2">Nome</th>
                            <th class="px-4 py-2">Descrição</th>
                            <th class="px-4 py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $department->name }}</td>
                                <td class="px-4 py-2">{{ $department->description }}</td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <a href="{{ route('equipes.edit', $department->id) }}" class="text-blue-600 hover:underline">Editar</a>
                                    <a href="{{ route('equipes.show', $department->id) }}" class="text-yellow-600 hover:underline">Visualizar</a>
                                    <form action="{{ route('equipes.destroy', $department->id) }}" method="POST" onsubmit="return confirm('Tem certeza?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>        
</x-app-layout>
