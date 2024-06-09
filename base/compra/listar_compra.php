<?php include "../painel/header.php"?>

    <div class="max-w-4xl mx-auto bg-white rounded p-5 overflow-x-auto">
        <h1 class="text-2xl mb-5">Registo Compra</h1>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id do Cliente</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id do Carro</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data da Compra</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comprovativo da Compra</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Excluir</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <?php 
include 'crud_compra_fun.php';

$compras = obterTodosCompra();
foreach($compras as $compra){
    echo "<tr>";
    echo "<td class='px-6 py-4 whitespace-nowrap'>".$compra["id_compra"] . "</td>";
    echo "<td class='px-6 py-4 whitespace-nowrap'>".$compra["id_cliente"] . "</td>";
    echo "<td class='px-6 py-4 whitespace-nowrap'>".$compra["id_carro"] . "</td>";
    echo "<td class='px-6 py-4 whitespace-nowrap'>".$compra["data_compra"] . "</td>";
    // Adicionando link de download para o comprovativo
    echo "<td class='px-6 py-4 whitespace-nowrap'><a href='" . $compra["comprovativo_compra"] . "' download>Download Comprovativo</a></td>";
    echo "<td class='px-6 py-4 whitespace-nowrap'><a href='excluir_compra.php?delete_id=" . $compra['id_compra'] . "' onclick=\"return confirm('Tem certeza que deseja excluir este carro?');\" class='text-red-500 hover:underline'>Excluir</a></td>";
    echo "</tr>";
}
?>
 

            </tbody> 
        </table>
    </div>

    <?php include "../painel/footer.php"?>

