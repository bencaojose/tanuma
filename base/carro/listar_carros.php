

<?php 
include "../painel/header.php"
?>

    <div class="max-w-4xl mx-auto bg-white rounded p-5 overflow-x-auto">
        <h1 class="text-2xl mb-5">Lista de Carros</h1>
        <a href="formulario_carro.html"  class="bg-blue-500 text-white py-2 px-4 rounded mb-4 inline-block">Adicionar Carro</a>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marca</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modelo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ano</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Atualizar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Excluir</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php
                include 'crud_car_fun.php';

                // Obter todos os carros
                $carros = obterTodosCarros();
                foreach ($carros as $carro) {
                    echo "<tr>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $carro['id_carro'] . "</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $carro['marca'] . "</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $carro['modelo'] . "</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $carro['ano'] . "</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'><a href='atualizar_carro.php?id_carro=" . $carro['id_carro'] . "' class='text-blue-500 hover:underline'>Atualizar</a></td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'><a href='excluir_carro.php?delete_id=" . $carro['id_carro'] . "' onclick=\"return confirm('Tem certeza que deseja excluir este carro?');\" class='text-red-500 hover:underline'>Excluir</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include "../painel/footer.php"?>

