<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cadastrar Marca/Modelo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                   <!-- Formulário para cadastrar marca/modelo -->
                    <form method="POST" action="{{ route('marcaveiculo.store') }}">
                        @csrf <!-- Token CSRF obrigatório para formulários POST no Laravel -->
                        <div class="flex items-center space-x-4">
                            <!-- Campo de entrada para a descrição da marca/modelo -->
                            <div class="flex-grow">
                                <input type="text" name="descricao" id="descricao"
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    value="{{ request('descricao') }}"
                                    placeholder="Marca/Modelo" required>
                            </div>

                            <!-- Botão de enviar -->
                            <div>
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Salvar
                                </button>
                            </div>
                        </div>

                        <!-- Checkbox para "Atualizar base" -->
                        <div class="mt-4">
                            <label for="atualizar_base" class="inline-flex items-center">
                                <input type="checkbox" name="atualizar_base" id="atualizar_base"
                                    class="form-checkbox h-5 w-5 rounded bg-gray-500 border-gray-600 text-indigo-500 focus:ring-indigo-500 focus:border-indigo-500">
                                <span class="ml-3 text-white">Atualizar base</span>
                            </label>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
