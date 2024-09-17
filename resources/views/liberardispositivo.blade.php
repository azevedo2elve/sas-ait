<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Liberar Dispositivo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                     
                    <!-- Formulário para filtro da marca modelo -->
                    <form method="GET" action="{{ route('liberardispositivo.procurardispositivo') }}">
                        <div class="flex items-center space-x-4">
                            <!-- Input Field -->
                            <div class="flex-grow">
                                {{-- <label for="marca" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Marca</label> --}}
                                <input type="number" name="imei" id="imei"
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    value="{{ request('imei') }}"
                                    placeholder="IMEI">
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

                <!-- Exibição dos Resultados -->
                <div class="overflow-x-auto">
                    @if(isset($dispositivos) && $dispositivos->count() > 0)
                        @foreach ($dispositivos as $dispositivo)
                            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg my-4">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <h5 class="text-xl font-bold">{{ $efetivo->nome }}</h5>
                                    <h6 class="text-sm text-gray-500"><b>IMEI:</b> {{ $dispositivo->device_id }}</h6>
                                    <h6 class="text-sm text-gray-500"><b>Modelo:</b> {{ $dispositivo->model }}</h6>
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
