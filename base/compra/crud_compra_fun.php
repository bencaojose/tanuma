<?php 
include '../../connection/conexao.php';

    function criaCompra($id_cliente, $id_carro, $data_compra, $comprovativo_compra){
        global $pdo;

        $stmt = $pdo->prepare("INSERT INTO compra(id_cliente, id_carro, data_compra, comprovativo_compra) VALUES (?, ?; ?; ?)");

        $stmt ->execute([$id_cliente, $id_carro, $data_compra, $comprovativo_compra]);
    }

    function obterTodosCompra(){
        global $pdo;

        $stmt = $pdo->query("SELECT * FROM compra");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function obterCompraPorId($id_compra){
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM compra WHERE id_compra =?");

        $stmt->execute([$id_compra]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     function excluirCompra($id_compra){
        global $pdo;

        $stmt = $pdo->prepare("DELETE FROM compra WHERE id_compra =?");

        $stmt->execute([$id_compra]);
     }


?>