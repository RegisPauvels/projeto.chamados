<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Detalhes do Chamado #{{ $ticket->id }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $ticket->title }}</h3>
                            <p class="text-gray-600">{{ $ticket->description }}</p>
                        </div>
                        <div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Status</p>
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $ticket->status == 'open' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $ticket->status == 'resolved' || $ticket->status == 'closed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $ticket->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ in_array($ticket->status, ['assigned', 'in_progress', 'on_hold']) ? 'bg-blue-100 text-blue-800' : '' }}">
                                        {{ $ticket->status_text }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Equipe Responsavel</p>
                                    <p class="font-medium">{{ $ticket->department->name ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Data de Abertura</p>
                                    <p class="font-medium">{{ $ticket->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Urgência</p>
                                    <p class="font-medium">{{ $ticket->urgency->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="flex justify-end space-x-3">
                        @if($ticket->status == 'open' || $ticket->status == 'assigned')
                            <form action="{{ route('chamados.cancel', $ticket->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja cancelar este chamado?')" 
                                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Cancelar Chamado
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

           
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Comentários</h3>
                    
                    <div class="space-y-4 mb-6">
                        @forelse($ticket->comments as $comment)
                            @if(!$comment->is_private || $comment->user_id == auth()->id())
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
                            @endif
                        @empty
                            <p class="text-gray-500 text-center py-4">Nenhum comentário ainda.</p>
                        @endforelse
                    </div>

                    
                    <form action="{{ route('chamados.comments.store', $ticket->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="content" class="sr-only">Adicionar comentário</label>
                            <textarea name="content" id="content" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"
                                    placeholder="Digite seu comentário..."
                                    required></textarea>
                        </div>
                        @if(auth()->user()->isAnalyst())
                            <div class="mb-4 flex items-center">
                                <input type="checkbox" name="is_private" id="is_private" 
                                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <label for="is_private" class="ml-2 block text-sm text-gray-700">
                                    Comentário privado (visível apenas para a equipe)
                                </label>
                            </div>
                        @endif
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