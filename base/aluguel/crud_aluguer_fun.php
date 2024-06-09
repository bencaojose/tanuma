<?php 
include '../../connection/conexao.php';

    function criaAluguel($id_cliente, $id_carro, $data_inicio, $data_fim, $comprovativo_aluguel){
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO aluguel(id_cliente, id_carro, data_inicio, data_fim, comprovativo_aluguel) VALUES(?, ?, ?, ?, ?)");

        $stmt ->execute([$id_cliente, $id_carro, $data_inicio, $data_fim, $comprovativo_aluguel]);
    }

    function obterTodosAluguel(){
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM aluguel");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function obterAluguelPorId($id_aluguel){
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM aluguel WHERE id_aluguel = ?");

        $stmt->execute([$id_aluguel]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function excluirAluguer($id_aluguel){
        global $pdo;

        $stmt = $pdo->prepare("DELETE FROM aluguel WHERE id_aluguel =?");

        $stmt ->execute([$id_aluguel]);
    }

?>