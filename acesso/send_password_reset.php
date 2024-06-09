<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclui o arquivo de configuração do banco de dados
include '../connection/conexao.php';
// Inclui o arquivo do PHPMailer
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['email'])) {
    try {
        $email = $_POST['email'];

        // Consulta SQL para verificar se o email pertence a um cliente
        $query = "SELECT * FROM cliente WHERE email=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);
        $cliente = $stmt->fetch();

        // Verifica se a consulta retornou algum resultado
        if ($cliente) {
            // Gere uma nova senha
            $nova_senha = gerarNovaSenha();

            // Atualiza a senha no banco de dados
            $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
            $query = "UPDATE cliente SET senha=? WHERE email=?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$nova_senha_hash, $email]);

            // Envie um email com a nova senha
            enviarEmail($email, $nova_senha);

            echo "Sua nova senha foi enviada para o seu email.";
        } else {
            echo "Email não encontrado.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Por favor, preencha seu email.";
}

// Função para gerar uma nova senha
function gerarNovaSenha() {
    // Gere uma nova senha aleatória
    $nova_senha = substr(md5(uniqid(rand(), true)), 0, 8);
    return $nova_senha;
}

// Função para enviar um email com a nova senha usando PHPMailer
function enviarEmail($email, $nova_senha) {
    // Instanciar a classe PHPMailer
    $mail = new PHPMailer(true);
    
    try {
        // Configuração do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Endereço do servidor SMTP
        $mail->SMTPAuth = true;             // Autenticação SMTP
        $mail->Username = 'autobbc18@gmail.com'; // Seu email
        $mail->Password = 'FimdoCurso@2024';      // Sua senha do email
        $mail->SMTPSecure = 'tls';          // TLS
        $mail->Port = 587;                  // Porta do servidor SMTP

        // Define o remetente
        $mail->setFrom('autobbc18@gmail.com', 'Admin do BBC Auto');

        // Define o destinatário
        $mail->addAddress($email);

        // Conteúdo do email
        $mail->isHTML(true);
        $mail->Subject = 'Recuperação de Senha';
        $mail->Body = "Sua nova senha: " . $nova_senha;

        // Enviar o email
        $mail->send();
    } catch (Exception $e) {
        echo "Mensagem de erro: {$mail->ErrorInfo}";
    }
}
?>
