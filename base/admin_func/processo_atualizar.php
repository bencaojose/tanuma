<?php 
include 'crud_user_fun.php';

function validarSenha($senha) {
    return strlen($senha) >= 6;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (validarSenha($senha)) {
        // A senha é válida, continue com o processamento

        // Criptografando a senha usando bcrypt
        $senhaCriptografada = password_hash($senha, PASSWORD_BCRYPT);

        $nivel_acesso = $_POST['nivel_acesso'];
        $morada = $_POST['morada'];
        $telefone = $_POST['telefone'];

        atualizarUser($id, $firstName, $lastName, $email, $senhaCriptografada, $nivel_acesso, $morada, $telefone);

        header("Location:listar_user.php");
         exit();
    } else {
        // A senha não atende aos requisitos mínimos
        echo "A senha deve ter pelo menos 6 caracteres.";
    }
}

?> 