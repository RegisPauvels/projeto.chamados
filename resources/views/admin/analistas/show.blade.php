<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Detalhes do Analista</h2>
    </x-slot>

    <div class="py-6 container mx-auto">
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-sm">
            <div class="mb-6 border-b pb-4">
                <h1 class="text-2xl font-bold text-gray-800">{{ $analyst->name }}</h1>
                <p class="text-gray-600 mt-2"><strong>Email:</strong> {{ $analyst->email }}</p>
                <p class="text-gray-600 mt-1"><strong>Departamento:</strong> {{ $analyst->department->name ?? 'N/A' }}</p>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('analistas.edit', $analyst->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Editar
                </a>
                <form action="{{ route('analistas.destroy', $analyst->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700" onclick="return confirm('Tem certeza que deseja excluir este analista?')">
                        Excluir
                    </button>
                </form>
                <div class="flex justify-end">
                <a href="{{ route('analistas.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 text-sm">
                    Voltar
                </a>
            </div>
            </div>

        </div>
    </div>
</x-app-layout>