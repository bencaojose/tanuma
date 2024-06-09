<?php include "../painel/header.php"?>

    <div class="max-w-4xl mx-auto bg-white rounded p-5 overflow-x-auto">
        <h1 class="text-2xl mb-5">Lista de Users</h1>
        <a href="user_form.html"  class="bg-blue-500 text-white py-2 px-4 rounded mb-4 inline-block">Adicionar Carro</a>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Primeiro Nome</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ultimo Nome</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Atualizar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Excluir</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php
                include 'crud_user_fun.php';

                // Obter todos os carros
                $useres = obterTodosUseres();
                foreach ($useres as $user) {
                    echo "<tr>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $user['id'] . "</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $user['firstName'] . "</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $user['lastName'] . "</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'>" . $user['email'] . "</td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'><a href='atualizar_user.php?id=" . $user['id'] . "' class='text-blue-500 hover:underline'>Atualizar</a></td>";
                    echo "<td class='px-6 py-4 whitespace-nowrap'><a href='excluir_user.php?delete_id=" . $user['id'] . "' onclick=\"return confirm('Tem certeza que deseja excluir este user?');\" class='text-red-500 hover:underline'>Excluir</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

<?php include "../painel/footer.php"?>
