<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Atendimento do Chamado #{{ $ticket->id }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('analista.chamados.update', $ticket->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $ticket->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ $ticket->description }}</p>
                                
                                <div class="mb-4">
                                    <label for="client" class="block text-sm font-medium text-gray-700 mb-1">Solicitante</label>
                                    <p class="text-gray-900">{{ $ticket->client->name }}</p>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="created_at" class="block text-sm font-medium text-gray-700 mb-1">Data de Abertura</label>
                                    <p class="text-gray-900">{{ $ticket->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                            
                           
                            <div>
                                
                                <div class="mb-4">
                                    <label for="department_id" class="block text-sm font-medium text-gray-700 mb-1">Departamento Responsável</label>
                                    <select name="department_id" id="department_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ $ticket->department_id == $department->id ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                
                                <div class="mb-4">
                                    <label for="analyst_id" class="block text-sm font-medium text-gray-700 mb-1">Analista Responsável</label>
                                    <select name="analyst_id" id="analyst_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                        <option value="">Não atribuído</option>
                                        @foreach($analysts as $analyst)
                                            <option value="{{ $analyst->id }}" {{ $ticket->analyst_id == $analyst->id ? 'selected' : '' }}>
                                                {{ $analyst->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                        @foreach(App\Models\Ticket::STATUSES as $key => $status)
                                            <option value="{{ $key }}" {{ $ticket->status == $key ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                
                                <div class="mb-4">
                                    <label for="urgency_level_id" class="block text-sm font-medium text-gray-700 mb-1">Nível de Urgência</label>
                                    <select name="urgency_level_id" id="urgency_level_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                        @foreach($urgencyLevels as $urgency)
                                            <option value="{{ $urgency->id }}" {{ $ticket->urgency_level_id == $urgency->id ? 'selected' : '' }}>
                                                {{ $urgency->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="flex justify-between items-center">
                            <div>
                                @if($ticket->isClosed())
                                    <span class="px-4 py-2 inline-flex items-center rounded-md bg-green-100 text-green-800">
                                        Chamado finalizado
                                    </span>
                                @endif
                            </div>
                            
                            <div class="flex space-x-3">
                                @if(!$ticket->isClosed())
                                    <button type="submit" 
                                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Salvar Alterações
                                    </button>
                                    
                                    @if($ticket->status != 'closed' && $ticket->status != 'resolved')
                                        <button type="button" onclick="document.getElementById('resolveForm').submit()"
                                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Resolver Chamado
                                        </button>
                                    @endif
                                @endif
                                
                                @if($ticket->status == 'open' || $ticket->status == 'assigned')
                                    <button type="button" onclick="document.getElementById('cancelForm').submit()"
                                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Cancelar Chamado
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                    
                    
                    <form id="resolveForm" action="{{ route('analista.chamados.resolve', $ticket->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('PATCH')
                    </form>
                    
                    <form id="cancelForm" action="{{ route('analista.chamados.cancel', $ticket->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('PATCH')
                    </form>
                </div>
            </div>

            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Comentários</h3>
                    
                    <div class="space-y-4 mb-6">
                        @forelse($ticket->comments as $comment)
                            <div class="flex {{ $comment->user_id == auth()->id() ? 'justify-end' : '' }}">
                                <div class="max-w-xs md:max-w-md lg:max-w-lg rounded-lg px-4 py-2 
                                    {{ $comment->user_id == auth()->id() ? 'bg-blue-100 text-blue-900' : 'bg-gray-100 text-gray-900' }}">
                                    <div class="flex items-center mb-1">
                                        <span class="font-medium">{{ $comment->user->name }}</span>
                                        <span class="text-xs text-gray-500 ml-2">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
                                        @if($comment->is_private)
                                            <span class="ml-2 text-xs bg-red-100 text-red-800 px-2 py-0.5 rounded-full">Privado</span>
                                        @endif
                                    </div>
                                    <p class="text-sm">{{ $comment->comment }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">Nenhum comentário ainda.</p>
                        @endforelse
                    </div>

                   
                    <form action="{{ route('analista.chamados.comments.store', $ticket->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="comment" class="sr-only">Adicionar comentário</label>
                            <textarea name="comment" id="comment" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                                    placeholder="Digite seu comentário..."
                                    required></textarea>
                        </div>
                        <div class="mb-4 flex items-center">
                            <input type="checkbox" name="is_private" id="is_private" 
                                class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded" value="1">
                            <label for="is_private" class="ml-2 block text-sm text-gray-700">
                                Comentário privado (visível apenas para a equipe)
                            </label>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Enviar Comentário
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>