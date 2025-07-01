<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Categorias</h2>
    </x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="py-6 px-8">
                @if (session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                <a href="{{ route('categorias.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Nova Categoria
                </a>

                <table class="min-w-full bg-white border rounded">
                    <thead>
                        <tr class="bg-gray-100 text-left text-sm uppercase">
                            <th class="px-4 py-2">Nome</th>
                            <th class="px-4 py-2">Descrição</th>
                            <th class="px-4 py-2">Equipe responsavel</th>
                            <th class="px-4 py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $category->name }}</td>
                                <td class="px-4 py-2">{{ $category->description }}</td>
                                <td class="px-4 py-2">{{ $category->department->name }}</td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <a href="{{ route('categorias.edit', $category->id) }}" class="text-blue-600 hover:underline">Editar</a>
                                    <a href="{{ route('categorias.show', $category->id) }}" class="text-yellow-600 hover:underline">Visualizar</a>
                                    <form action="{{ route('categorias.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Tem certeza?')">
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
