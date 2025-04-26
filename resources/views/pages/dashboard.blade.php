@extends('layouts.main')
@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-semibold text-gray-800 mb-8">Painel Administrativo</h1>

    <div class="flex justify-end">
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-10 " onclick="console.log('Relatório gerado')">Gerar Relatório</button>
    </div>
    
    <!-- Cards de Métricas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Pedidos do Mês -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 mr-4">
                    <i class="fas fa-shopping-bag text-blue-500"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Pedidos do Mês</p>
                    <p class="text-2xl font-semibold text-gray-700">45</p>
                </div>
            </div>
        </div>

        <!-- Faturamento -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 mr-4">
                    <i class="fas fa-dollar-sign text-green-500"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Faturamento</p>
                    <p class="text-2xl font-semibold text-gray-700">R$ 3.250,00</p>
                </div>
            </div>
        </div>

        <!-- Produtos Cadastrados -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 mr-4">
                    <i class="fas fa-box text-purple-500"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Produtos</p>
                    <p class="text-2xl font-semibold text-gray-700">28</p>
                </div>
            </div>
        </div>

        <!-- Clientes -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 mr-4">
                    <i class="fas fa-users text-red-500"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Clientes</p>
                    <p class="text-2xl font-semibold text-gray-700">156</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Últimos Pedidos -->
    <div class="bg-white rounded-lg shadow mb-8">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Últimos Pedidos</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pedido
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cliente
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Valor
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">#1234</td>
                            <td class="px-6 py-4 whitespace-nowrap">Maria Silva</td>
                            <td class="px-6 py-4 whitespace-nowrap">R$ 150,00</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Entregue
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">#1233</td>
                            <td class="px-6 py-4 whitespace-nowrap">João Santos</td>
                            <td class="px-6 py-4 whitespace-nowrap">R$ 85,00</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Em Preparo
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">#1232</td>
                            <td class="px-6 py-4 whitespace-nowrap">Ana Oliveira</td>
                            <td class="px-6 py-4 whitespace-nowrap">R$ 220,00</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Em Entrega
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection