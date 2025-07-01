<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Nova Categoria</h2>
    </x-slot>

    <div class="py-6 container mx-auto">
        <form action="{{ route('categorias.store') }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-sm">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Nome</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm" 
                       required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Descrição</label>
                <textarea name="description" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm">{{ old('description', $department->description ?? '') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Equipe Responsavel</label>
                <select name="department_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm" required>
                    <option value="">Selecione uma equipe</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('categorias.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 text-sm">
                    Voltar
                </a>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 text-sm">
                    Criar Categoria
                </button>
            </div>
        </form>
    </div>
</x-app-layout>