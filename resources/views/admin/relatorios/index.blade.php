<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Relatórios do Sistema</h2>
            <a href="{{ route('relatorios.chamados') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                Relatorios por chamados 
            </a>
        </div>
    </x-slot>

    <div class="py-6 container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Top 5 Analistas (Mais Resoluções)</h3>
                
                @if($topAnalistas->count() > 0)
                    <div class="space-y-4">
                        @foreach($topAnalistas as $analyst)
                        <div class="flex justify-between items-center border-b pb-2">
                            <div>
                                <p class="font-medium">{{ $analyst->name }}</p>
                                <p class="text-sm text-gray-600">{{ $analyst->email }}</p>
                            </div>
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                                {{ $analyst->resolved_tickets }} resolvidos
                            </span>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Nenhum dado disponível</p>
                @endif
            </div>

           
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Top 5 Departamentos (Mais Chamados)</h3>
                
                @if($topEquipes->count() > 0)
                    <div class="space-y-4">
                        @foreach($topEquipes as $department)
                        <div class="flex justify-between items-center border-b pb-2">
                            <p class="font-medium">{{ $department->name }}</p>
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                {{ $department->tickets_count }} chamados
                            </span>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Nenhum dado disponível</p>
                @endif
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Top 5 Categorias (Mais Chamados)</h3>
                
                @if($topCategorias->count() > 0)
                    <div class="space-y-4">
                        @foreach($topCategorias as $category)
                        <div class="flex justify-between items-center border-b pb-2">
                            <p class="font-medium">{{ $category->name }}</p>
                            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">
                                {{ $category->tickets_count }} chamados
                            </span>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Nenhum dado disponível</p>
                @endif
            </div>

        
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Chamados por Nível de Urgência</h3>
                
                @if($chamadosPorUrgencia->count() > 0)
                    <div class="space-y-4">
                        @foreach($chamadosPorUrgencia as $item)
                        <div class="flex justify-between items-center border-b pb-2">
                            <p class="font-medium">{{ $item->urgency_name }}</p>
                            <span class="bg-{{ 
                                $item->urgency_name == 'Alta' ? 'red' : 
                                ($item->urgency_name == 'Média' ? 'yellow' : 'green') 
                            }}-100 text-{{ 
                                $item->urgency_name == 'Alta' ? 'red' : 
                                ($item->urgency_name == 'Média' ? 'yellow' : 'green') 
                            }}-800 px-3 py-1 rounded-full text-sm">
                                {{ $item->total }} chamados
                            </span>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Nenhum dado disponível</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>