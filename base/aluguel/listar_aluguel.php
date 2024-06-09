

<?php include "../painel/header.php"?>

    <div class="max-w-4xl mx-auto bg-white rounded p-5 overflow-x-auto">
        <h1 class="text-2xl mb-5">Registo de Aluguel</h1>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id do Cliente</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id do Carro</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data da Inicio</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data do Fim</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comprovativo do Aluguel</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Excluir</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php 
                include 'crud_aluguer_fun.php';

                $alugueres = obterTodosAluguel();
                foreach($alugueres as $aluguel){
                    echo"<tr>";
                    echo"<td class='px-6 py-4 whitespace-nowrap'>".$aluguel["id_compra"] . "</td>";
                    echo"<td class='px-6 py-4 whitespace-nowrap'>".$aluguel["id_cliente"] . "</td>";
                    echo"<td class='px-6 py-4 whitespace-nowrap'>".$aluguel["id_carra"] . "</td>";
                    echo"<td class='px-6 py-4 whitespace-nowrap'>".$aluguel["data_inicio"] . "</td>";
                    echo"<td class='px-6 py-4 whitespace-nowrap'>".$aluguel["data_fim"] . "</td>";
                    echo"<td class='px-6 py-4 whitespace-nowrap'>".$aluguel["comprovativo_aluguel"] . "</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'><a href='excluir_aluguel.php?delete_id=" . $aluguel['id_aluguel'] . "' onclick=\"return confirm('Tem certeza que deseja excluir este carro?');\" class='text-red-500 hover:underline'>Excluir</a></td>";
                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>
    </div>

    <?php include "../painel/footer.php"?>

