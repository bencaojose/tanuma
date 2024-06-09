<?php 
include '../../connection/conexao.php';

function criaRoubo($id_carro, $data_roubo, $local_roubo, $descricao_roubo, $status_recuperacao,){
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO registro_roubo(id_carro, data_roubo, local_roubo, descricao_roubo, status_recuperacao)VALUES (?, ?, ?, ?, ?)");

    $stmt ->execute([$id_carro, $data_roubo, $local_roubo, $descricao_roubo, $status_recuperacao]);
}

function obterTodosRoubo(){
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM registro_roubo");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obterRouboPorId($id_registro){
    global $pdo;
    $stmt = $pdo ->prepare("SELECT * FROM registro_roubo WHERE id_registro=?");

    $stmt->execute([$id_registro]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function atualizarRoubo($id_registro, $id_carro, $data_roubo, $local_roubo, $descricao_roubo, $status_recuperacao){
    global $pdo;
    $stmt = $pdo->prepare("UPDATE registro_roubo SET id_carro=?, data_roubo=?, local_roubo=?, descricao_roubo=?, status_recuperacao=? WHERE id_registro=?");
    
    $stmt->execute([$id_carro, $data_roubo, $local_roubo, $descricao_roubo, $status_recuperacao, $id_registro]);
}


function excluirRoubo($id_registro){
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM registro_roubo WHERE id_registro =?");
    $stmt ->execute([$id_registro]);
}
?>