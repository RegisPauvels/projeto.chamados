<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Detalhes da Equipe</h2>
    </x-slot>

    <div class="py-6 container mx-auto">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-sm">
            <div class="mb-6 border-b pb-4">
                <h1 class="text-2xl font-bold text-gray-800">{{ $department->name }}</h1>
                <p class="text-gray-600 mt-2">{{ $department->description }}</p>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Analistas desta Equipe</h3>
                
                @if($department->analysts->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($department->analysts as $analyst)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $analyst->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $analyst->email }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-sm">Nenhum analista vinculado a esta equipe.</p>
                @endif
            </div>
            <div class="flex justify-end">
                <a href="{{ route('equipes.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 text-sm">
                    Voltar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>