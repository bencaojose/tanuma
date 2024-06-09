<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario'])) {
    // Se não estiver autenticado, redirecionar para a página de login
    header("Location: ../acesso/login.html");
    exit(); // Parar a execução do script após o redirecionamento
}

// Verificar se o usuário tem permissão de admin ou funcionário
$nivel_acesso = $_SESSION['usuario']['nivel_acesso'];
if ($nivel_acesso !== 'Admin' && $nivel_acesso !== 'Funcionario') {
    // Se não tiver permissão, redirecionar para a página de acesso não autorizado ou exibir uma mensagem de erro
    echo "Acesso não autorizado!";
    exit(); // Parar a execução do script
}
?>
