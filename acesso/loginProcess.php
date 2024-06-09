<?php
session_start();

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        include '../connection/conexao.php';

        try {
            $email = $_POST['email'];
            $senha = $_POST['password'];

            $query = "SELECT * FROM funcionario_administrador WHERE email=?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$email]);
            $usuario = $stmt->fetch();

            if ($usuario && password_verify($_POST['password'], $usuario['senha'])) {
                $_SESSION['usuario'] = $usuario;
                if ($usuario['nivel_acesso'] == 'Admin') {
                    header("Location: ../base/dashboard/dashboard_central.php");
                } else {
                    header("Location: ../base/dashboard/dashboard_central.php");
                }
                exit();
            } else {
                $erro = "Email ou senha incorretos.";
            }

            $query = "SELECT * FROM cliente WHERE email=?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$email]);
            $cliente = $stmt->fetch();

            if ($cliente && password_verify($senha, $cliente['senha'])) {
                $_SESSION['cliente'] = $cliente;
                header("location: ../page/home.php");
                exit();
            }

            $erro = "Credenciais inválidas.";
        } catch (PDOException $e) {
            $erro = "Erro: " . $e->getMessage();
        }
    } else {
        $erro = "Por favor, preencha todos os campos.";
    }

    header("Location: login.html?erro=" . urlencode($erro));
    exit();
}
?>
