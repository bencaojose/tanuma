<?php 
include '../../connection/conexao.php';

    function criarCliente($firstName, $lastName, $telefone, $email, $endereco, $numero_contribuinte, $genero, $senha){
        global $pdo;

        $stmt = $pdo->prepare("INSERT INTO cliente(firstName, lastName, telefone, email, endereco, numero_contribuinte, genero, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt ->execute([$firstName, $lastName, $telefone, $email, $endereco, $numero_contribuinte, $genero, $senha]);
    }


    function obterTodosClientes(){
        global $pdo;

        $stmt = $pdo->query("SELECT * FROM cliente");
        return $stmt ->fetchAll(PDO::FETCH_ASSOC);
    }

    function obterClientePorId($id_cliente){
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM cliente WHERE id_cliente =?");
        $stmt->execute([$id_cliente]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function excluirCliente($id_cliente){
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM cliente WHERE id_cliente=?");
        $stmt->execute([$id_cliente]);
    }

?>