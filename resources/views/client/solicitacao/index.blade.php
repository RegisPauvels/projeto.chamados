<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Selecione um tipo de solicitação:</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <a href="{{ route('solicitacao.create', ['titulo'=>'periferico', 'categoryId' => 1, 'urgencyId' => 2]) }}" class="flex flex-col items-center p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 hover:border-green-500">
                    <div class="p-3 bg-green-100 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Solicitar Periférico</h3>
                    <p class="text-gray-500 text-center text-sm">Teclado, mouse, monitor e outros acessórios</p>
                </a>

                <a href="{{ route('solicitacao.create', ['titulo'=>'movimentacao', 'categoryId' => 1, 'urgencyId' => 2]) }}" class="flex flex-col items-center p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 hover:border-blue-500">
                    <div class="p-3 bg-blue-100 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Solicitar Movimentação</h3>
                    <p class="text-gray-500 text-center text-sm">Mudança de local ou transferência de equipamentos</p>
                </a>

               
                <a href="{{ route('solicitacao.create', ['titulo'=>'desktop', 'categoryId' => 1, 'urgencyId' => 2]) }}" class="flex flex-col items-center p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 hover:border-purple-500">
                    <div class="p-3 bg-purple-100 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Solicitar Desktop/Notebook</h3>
                    <p class="text-gray-500 text-center text-sm">Computadores novos ou substituição</p>
                </a>

              
                <a href="{{ route('solicitacao.create', ['titulo'=>'rede', 'categoryId' => 5, 'urgencyId' => 2]) }}" class="flex flex-col items-center p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 hover:border-yellow-500">
                    <div class="p-3 bg-yellow-100 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Solicitar Ponto de Rede</h3>
                    <p class="text-gray-500 text-center text-sm">Instalação ou manutenção de conexão de rede</p>
                </a>

               
                <a href="{{ route('solicitacao.create', ['titulo'=>'software', 'categoryId' => 4, 'urgencyId' => 2]) }}" class="flex flex-col items-center p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 hover:border-red-500">
                    <div class="p-3 bg-red-100 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Solicitar Software</h3>
                    <p class="text-gray-500 text-center text-sm">Instalação ou licença de programas</p>
                </a>
           
                <a href="{{ route('solicitacao.create', ['titulo'=>'telefonia', 'categoryId' => 3, 'urgencyId' => 2]) }}" class="flex flex-col items-center p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 hover:border-indigo-500">
                    <div class="p-3 bg-indigo-100 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Solicitar Ramal</h3>
                    <p class="text-gray-500 text-center text-sm">Instalação ou criação de ramal</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>