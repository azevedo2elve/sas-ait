<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Marca Veículo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Container Flex para os Botões -->
                    <div class="mt-4 mb-6 flex space-x-4">
                        <!-- Botão de Cadastro -->
                        <a href="{{ route('marcaveiculo.create') }}"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Cadastrar Nova Marca/Modelo
                        </a>

                        <!-- Botão de Atualização -->
                        <a href="{{ route('marcaveiculo.create') }}"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Atualizar Base de Dados
                        </a>
                    </div>


                    <!-- Formulário para filtro da marca modelo -->
                    <form method="GET" action="{{ route('marcaveiculo.index') }}">
                        <div class="flex items-center space-x-4">
                            <!-- Input Field -->
                            <div class="flex-grow">
                                {{-- <label for="marca" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Marca</label> --}}
                                <input type="text" name="marca" id="marca"
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    value="{{ request('marca') }}"
                                    placeholder="Marca/Modelo">
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
                    <table class="min-w-full divide-y divide-gray-200 mt-4">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Marca
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Data da Atualização
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Ação
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-600">
                            @forelse ($resultados as $veiculo)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $veiculo->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $veiculo->descricao }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        {{ $veiculo->data_atualizacao }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                        <!-- Formulário para deletar -->
                                        <form action="{{ route('marcaveiculo.destroy', $veiculo->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este veículo?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                Deletar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-300">
                                        Nenhum veículo encontrado
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginação -->
                <div class="mt-4">
                    {{ $resultados->links('pagination::tailwind') }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
