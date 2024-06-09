<?php 
session_start(); // Iniciar a sessão para verificar a autenticação do usuário

// Verificar se o usuário está autenticado como cliente
if (!isset($_SESSION['cliente'])) {
    // Se não estiver autenticado, redirecionar para a página de login
    header("Location: ../acesso/login.html");
    exit(); // Parar a execução do script após o redirecionamento
}

// Recuperar o ID do cliente da sessão
$id_cliente = $_SESSION['cliente']['id_cliente'];

// Se o usuário estiver autenticado, continue com o conteúdo da página
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-900">Atualizar Perfil</h2>
        <form action="update_profile.php" method="post">
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="telefone" class="block text-gray-700">Telefone</label>
                <input type="text" name="telefone" id="telefone" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="current_password" class="block text-gray-700">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="new_password" class="block text-gray-700">New Password</label>
                <input type="password" name="new_password" id="new_password" class="w-full p-2 border border-gray-300 rounded mt-1">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded mt-4 hover:bg-blue-600">Update Profile</button>
        </form>
    </div>
</div>
</body>
</html>
