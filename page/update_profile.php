<?php
// Iniciar a sessão
session_start();
include "../connection/conexao.php";

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Endereço de email inválido.";
        exit();
    }

    // Validar senha nova (se fornecida)
    if (!empty($new_password) && strlen($new_password) < 8) {
        echo "A nova senha deve ter pelo menos 8 caracteres.";
        exit();
    }

    // Verificar o ID do cliente a partir da sessão (ajustar conforme necessário)
    $id_cliente = $_SESSION['id_cliente'];

    // Verificar se a senha atual está correta
    $stmt = $pdo->prepare("SELECT senha FROM cliente WHERE id_cliente = :id_cliente");
    $stmt->execute(['id_cliente' => $id_cliente]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cliente || !password_verify($current_password, $cliente['senha'])) {
        echo "Senha atual incorreta.";
        exit();
    }

    // Atualizar o email e telefone
    $update_stmt = $pdo->prepare("UPDATE cliente SET email = :email, telefone = :telefone WHERE id_cliente = :id_cliente");
    $update_stmt->execute([
        'email' => $email,
        'telefone' => $telefone,
        'id_cliente' => $id_cliente,
    ]);

    // Atualizar a senha se um novo valor foi fornecido
    if (!empty($new_password)) {
        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $update_password_stmt = $pdo->prepare("UPDATE cliente SET senha = :senha WHERE id_cliente = :id_cliente");
        $update_password_stmt->execute([
            'senha' => $new_password_hashed,
            'id_cliente' => $id_cliente,
        ]);
    }

    echo "Perfil atualizado com sucesso.";
}
?>
