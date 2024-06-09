<?php 
include '../../connection/conexao.php';

function criarUser($firstName, $lastName, $email, $senha, $nivel_acesso, $morada, $telefone
){
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO funcionario_administrador(firstName, lastName, email, senha, nivel_acesso, morada, telefone) VALUES(?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([$firstName, $lastName, $email, $senha, $nivel_acesso, $morada, $telefone]);
}

function obterTodosUseres(){
    global $pdo;

    $stmt = $pdo->query("SELECT * FROM funcionario_administrador");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obterUserPorId($id){
    global $pdo;

    $stmt = $pdo ->prepare("SELECT * FROM funcionario_administrador WHERE id=?");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function atualizarUser($id, $firstName, $lastName, $email, $senha, $nivel_acesso, $morada, $telefone){
    global $pdo;

    $stmt = $pdo->prepare("UPDATE funcionario_administrador SET firstName=?, lastName=?, email=?, nivel_acesso=?, morada=?, telefone=? WHERE id=?");

    $stmt->execute([$firstName, $lastName, $email, $senha, $nivel_acesso, $morada, $telefone]);
}

function excluirUser($id){
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM funcionario_administrador WHERE id=?");
    $stmt ->execute([$id]);
}

?>