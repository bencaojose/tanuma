<?php
include '../../connection/conexao.php';

// Função para criar um novo registro de carro
function criarCarro($marca, $modelo, $ano, $cor, $tracao, $transmissao, $preco, $combustivel, $quilometros, $tipo_uso, $disponibilidade, $foto_completa) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO carro (marca, modelo, ano, cor, tracao, transmissao, preco, combustivel, quilometros, tipo_uso, disponibilidade, foto_completa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$marca, $modelo, $ano, $cor, $tracao, $transmissao, $preco, $combustivel, $quilometros, $tipo_uso, $disponibilidade, $foto_completa]);
}

// Função para obter todos os carros
function obterTodosCarros() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM carro");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// No arquivo crud_car_fun.php
function obterCarroPorId($id_carro) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM carro WHERE id_carro = ?");
    $stmt->execute([$id_carro]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


// Função para atualizar informações de um carro
function atualizarCarro($id_carro, $marca, $modelo, $ano, $cor, $tracao, $transmissao, $preco, $combustivel, $quilometros, $tipo_uso, $disponibilidade, $foto_completa) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE carro SET marca=?, modelo=?, ano=?, cor=?, tracao=?, transmissao=?, preco=?, combustivel=?, quilometros=?, tipo_uso=?, disponibilidade=?, foto_completa=? WHERE id_carro=?");
    
    $stmt->execute([$marca, $modelo, $ano, $cor, $tracao, $transmissao, $preco, $combustivel, $quilometros, $tipo_uso, $disponibilidade, $foto_completa, $id_carro]);
}

// Função para excluir um carro
function excluirCarro($id_carro) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM carro WHERE id_carro=?");
    $stmt->execute([$id_carro]);
}
?>
