<?php
// Inicia a sessão
session_start();

// Limpa os dados da sessão
$_SESSION = array();

// Destroi completamente a sessão
session_destroy();

// Redireciona para a página de login
header("Location: ../index.php");
exit();
?>
