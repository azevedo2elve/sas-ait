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
                                <input type="number" name="matricula" id="matricula"
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

                    @if (session('deslogado'))
                        <div class="bg-green-500 text-white p-4 rounded mb-4 mt-4">
                            {{ session('deslogado') }}
                        </div>
                    @endif

                    @if (session('offline'))
                        <div class="bg-red-500 text-white p-4 rounded mb-4 mt-4">
                            {{ session('offline') }}
                        </div>
                    @endif

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
                                        <form action="{{ route('sessaomobile.deslogarefetivo', $efetivo->id) }}" method="POST" class="ml-auto">
                                            @csrf
                                            <button type="submit" class="bg-red-500 text-white font-semibold py-2 px-4 rounded hover:bg-red-600">
                                                Deslogar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @if(isset($pesquisarealizada) && $pesquisarealizada)
                            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg my-4 p-6">
                                <p class="text-gray-500 dark:text-gray-300 text-center font-semibold">Nenhum efetivo encontrado.</p>
                            </div>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
