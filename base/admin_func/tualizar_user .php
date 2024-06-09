<?php 

// Iniciar a sessão
session_start();

// Verificar se o usuário está autenticado como administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['nivel_acesso'] !== 'Admin') {
    // Se não estiver autenticado como administrador, redirecionar para uma página de erro ou para a página inicial
    header("Location: error.php"); // Substitua "error.php" pelo caminho da página de erro desejada
    exit();
}

// Incluir o arquivo de funções do CRUD para usuários
include 'crud_user_fun.php';

// Verificar se o método de requisição é GET e se foi definido um parâmetro de ID para a atualização
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])) {

    $id = $_GET['id'];

    $user = obterUserPorId($id);

    if ($user) {
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar User</title>

     <!-- Adicione o link para o CSS do Tailwind -->
     <link rel="stylesheet" href="../../src/output.css">
     <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body class="bg-gray-100 py-12">
    <div class="max-w-md mx-auto bg-white rounded p-5">
        <h1 class="text-2xl mb-5">Atualizar User</h1>
        
        <form action="processo_atualizar.php" method="post">

            <div class="mb-4">
                <label for="firstName" class="block text-sm font-medium text-gray-700">Primeiro Nome</label>
                <input type="text" name="firstName" id="firstName" <?php echo $user['firstName']; ?> class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="lastName" class="block text-sm font-medium text-gray-700">Ultimo Nome</label>
                <input type="text" name="lastName" id="lastName" <?php echo $user['lastName']; ?> class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" <?php echo $user['email']; ?> class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>
            
            <div class="mb-4">
                <label for="senha" class="block text-sm font-medium text-gray-700">Senha</label>
                <input type="password" name="senha" id="senha" <?php echo $user['senha']; ?> class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="nivel_acesso" class="block text-sm font-medium text-gray-700">Nivel de Acesso</label>
                <select name="nivel_acesso" id="nivel_acesso" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                    <option value="Funcionario" <?php if($user['Funcionario'] == 'Funcionario') echo 'selected'; ?> >Funcionario</option>
                    <option value="Admin" <?php if($user['Admin'] == 'Admin') echo 'selected'; ?> >Administrador</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="morada" class="block text-sm font-medium text-gray-700">Morada</label>
                <input type="text" name="morada" id="morada" <?php echo $user ['morada']; ?> class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <div class="mb-4">
                <label for="telefone" class="block text-sm font-medium text-gray-700">telefone</label>
                <input type="number" name="telefone" id="telefone" <?php echo $user['telefone']; ?>  class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <div class="mb-4"><input type="button" value="Atualizar" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 cursor-pointer"></div>
        </form>
    </div>
    
</body>
</html>

<?php 
    } else {
        echo "User não encontrado.";
    }    
} else {
    echo "ID do usuário não especificado.";
}

?>