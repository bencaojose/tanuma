
<?php 
include "../painel/header.php"
?>

    <div class="max-w-4xl mx-auto bg-white rounded p-5 overflow-x-auto">
        <h1 class="text-2xl mb-5">Registo de cliente</h1>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Primeiro Nome</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ultimo Nome</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Endereço</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Excluir</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php 
                include 'crud_client_fun.php';

                $clientes = obterTodosClientes();
                foreach($clientes as $cliente){
                    echo"<tr>";
                    echo"<td class='px-6 py-4 whitespace-nowrap'>".$cliente["id_cliente"] . "</td>";
                    echo"<td class='px-6 py-4 whitespace-nowrap'>".$cliente["firstName"] . "</td>";
                    echo"<td class='px-6 py-4 whitespace-nowrap'>".$cliente["lastName"] . "</td>";
                    echo"<td class='px-6 py-4 whitespace-nowrap'>".$cliente["telefone"] . "</td>";
                    echo"<td class='px-6 py-4 whitespace-nowrap'>".$cliente["email"] . "</td>";
                    echo"<td class='px-6 py-4 whitespace-nowrap'>".$cliente["endereco"] . "</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'><a href='excluir_cliente.php?delete_id=" . $cliente['id_cliente'] . "' onclick=\"return confirm('Tem certeza que deseja excluir este cliente?');\" class='text-red-500 hover:underline'>Excluir</a></td>";
                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>
    </div>

    <?php include "../painel/footer.php"?>


