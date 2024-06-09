<?php 
// Incluindo o arquivo de conexão com o banco de dados
include '../../connection/conexao.php';

// Função para escapar dados
function sanitize($data) {
    return htmlspecialchars(strip_tags($data));
}

// Função para validar e-mail
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Função para criar um novo usuário no banco de dados
function criarUser($firstName, $lastName, $email, $senha, $nivel_acesso, $morada, $telefone) {
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO funcionario_administrador (firstName, lastName, email, senha, nivel_acesso, morada, telefone) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$firstName, $lastName, $email, $senha, $nivel_acesso, $morada, $telefone]);
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    // Sanitizando dados de entrada
    $firstName = sanitize($_POST['firstName']);
    $lastName = sanitize($_POST['lastName']);
    $email = sanitize($_POST['email']);
    $senha = $_POST['senha']; // Não vamos sanitizar a senha, pois vamos hashá-la
    $nivel_acesso = sanitize($_POST['nivel_acesso']);
    $morada = sanitize($_POST['morada']);
    $telefone = sanitize($_POST['telefone']);

    // Validando o e-mail
    if (!validateEmail($email)) {
        // Tratar o erro de e-mail inválido
        echo "Endereço de e-mail inválido.";
        exit();
    }

    // Verificar se o e-mail já está registrado no banco de dados
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM funcionario_administrador WHERE email=?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        // Tratar o erro de e-mail já existente
        echo "Este endereço de e-mail já está registrado.";
        exit();
    }

    // Hash da senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Criando o usuário no banco de dados
    criarUser($firstName, $lastName, $email, $senha_hash, $nivel_acesso, $morada, $telefone);

    // Redirecionar para a página de listagem de usuários após o cadastro bem-sucedido
    header("Location: listar_user.php");
    exit();
}
?>
