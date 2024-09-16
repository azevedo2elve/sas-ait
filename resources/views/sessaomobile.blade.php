<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sessão Mobile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Formulário para filtro da marca modelo -->
                    <form method="GET" action="{{ route('sessaomobile.procurarefetivo') }}">
                        <div class="flex items-center space-x-4">
                            <!-- Input Field -->
                            <div class="flex-grow">
                                {{-- <label for="marca" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Marca</label> --}}
                                <input type="text" name="marca" id="marca"
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    value="{{ request('matricula') }}"
                                    placeholder="Matricula Efetivo">
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Pesquisar
                                </button>
                            </div>
                        </div>
                    </form>

                    @if (session('success'))
                        <div class="alert alert-success p-4 bg-green-500 text-white rounded shadow-lg fade-out mt-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger p-4 bg-red-500 text-white rounded shadow-lg fade-out mt-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('delete'))
                        <div class="alert alert-danger p-4 bg-indigo-700 text-white rounded shadow-lg fade-out mt-4">
                            {{ session('delete') }}
                        </div>
                    @endif
                </div>

                <!-- Exibição dos Resultados -->
                <div class="overflow-x-auto">
                    @if(isset($efetivos) && $efetivos->count() > 0)
                        @foreach ($efetivos as $efetivo)
                            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg my-4">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <h5 class="text-xl font-bold">{{ $efetivo->nome }}</h5>
                                    <h6 class="text-sm text-gray-500"><b>Matrícula:</b> {{ $efetivo->matricula }}</h6>
                                    <h6 class="text-sm text-gray-500"><b>CPF:</b> {{ $efetivo->cpf }}</h6>
                                    <h6 class="text-sm text-gray-500"><b>Sistema:</b> {{ $efetivo->descricao_instancia_sistema }}</h6>

                                    <div class="mt-4 flex items-center">
                                        <span class="mr-2 inline-block w-3 h-3 rounded-full {{ $efetivo->sessao && count($efetivo->sessao) > 0 ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                        <button class="ml-auto bg-red-500 text-white font-semibold py-2 px-4 rounded hover:bg-red-600"
                                            onclick="deslogar({{ $efetivo->id }})">
                                            Deslogar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 dark:text-gray-300">Nenhum efetivo encontrado.</p>
                    @endif
                    
                </div>

                <!-- Paginação -->
                <div class="mt-4">
                    {{-- {{ $resultados->links('pagination::tailwind') }} --}}
                </div>

            </div>
            
        </div>
    </div>
</x-app-layout>
