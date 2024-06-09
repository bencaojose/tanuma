<?php 

// Iniciar a sessão
session_start();

// Incluir o arquivo de funções do CRUD para clientes
include 'crud_client_fun.php';

// Verificar se o usuário está autenticado como administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['nivel_acesso'] !== 'Admin') {
    // Se não estiver autenticado como administrador, redirecionar para uma página de erro ou para a página inicial
    header("Location: error.php"); // Substitua "error.php" pelo caminho da página de erro desejada
    exit();
}

// Verificar se o método de requisição é GET e se foi definido um parâmetro de ID para exclusão
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['delete_id'])) {
    // Obter o ID do cliente a ser excluído
    $id_cliente = $_GET['delete_id'];

    // Excluir o cliente
    excluirCliente($id_cliente);

    // Redirecionar de volta para a página de listagem de clientes após a exclusão
    header("Location: listar_cliente.php");
    exit();
}

?>
