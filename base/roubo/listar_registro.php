
<?php include "../painel/header.php"?>

    <div class="max-w-4xl mx-auto bg-white rounded p-5 overflow-x-auto">
        <h1 class="text-2xl mb-5">Lista de Registros de Roubo</h1>
        <a href="form_registro.htm" class="bg-blue-500 text-white py-2 px-4 rounded mb-4 inline-block">Adicionar Roubo</a>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID do Carro</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data do Roubo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Local do Roubo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Atualizar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Excluir</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php
                include 'crud_roubo_fun.php';

                // Obter todos os carros
                $roubos = obterTodosRoubo();
                foreach ($roubos as $roubo) {
                    echo "<tr>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $roubo['id_registro'] . "</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $roubo['id_carro'] . "</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $roubo['data_roubo'] . "</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $roubo['local_roubo'] . "</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $roubo['descricao_roubo'] . "</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $roubo['status_recuperacao'] . "</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'><a href='atualizar_registo.php?id_registro=" . $roubo['id_registro'] . "' class='text-blue-500 hover:underline'>Atualizar</a></td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'><a href='excluir_registro.php?delete_id=" . $roubo['id_registro'] . "' onclick=\"return confirm('Tem certeza que deseja excluir este registro?');\" class='text-red-500 hover:underline'>Excluir</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include "../painel/footer.php"?>

