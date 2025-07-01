<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Abrir novo chamado
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('chamados.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="client_id" value="{{ auth()->id() }}">
                        
                       
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                Título do Chamado *
                            </label>
                            <input type="text" name="title" id="title" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                                   value="{{ old('title') }}"
                                   required
                                   placeholder="Descreva brevemente o problema">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                     
                        <div class="mb-6">
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Categoria *
                            </label>
                            <select name="category_id" id="category_id" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                                    required>
                                <option value="">Selecione uma categoria</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                            
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Nível de Urgência *
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach($urgencyLevels as $urgency)
                                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50
                                    {{ old('urgency_level_id') == $urgency->id ? 'border-green-500 bg-green-50' : 'border-gray-300' }}">
                                    <input type="radio" name="urgency_level_id" value="{{ $urgency->id }}" 
                                           class="h-4 w-4 text-green-600 focus:ring-green-500"
                                           {{ old('urgency_level_id') == $urgency->id ? 'checked' : '' }}
                                           required>
                                    <div class="ml-3">
                                        <span class="block text-sm font-medium text-gray-700">{{ $urgency->name }}</span>
                                        <span class="block text-xs text-gray-500">{{ $urgency->description }}</span>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                            @error('urgency_level_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                      
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                Descrição Detalhada *
                            </label>
                            <textarea name="description" id="description" rows="6"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                                      required
                                      placeholder="Descreva o problema com detalhes, incluindo passos para reproduzir o erro, se aplicável">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                       
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('cliente.dashboard') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Cancelar
                            </a>
                            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Abrir Chamado
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>