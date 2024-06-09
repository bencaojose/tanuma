<?php

include 'crud_car_fun.php';

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $cor = $_POST['cor'];
    $tracao = $_POST['tracao'];
    $transmissao = $_POST['$transmissao'];
    $preco = $_POST['preco'];
    $combustivel = $_POST['combustivel'];
    $quilometros = $_POST['$quilometros'];
    $tipo_uso = $_POST['$tipo_uso'];
    $disponibilidade = ['disponibilidade'];
    $foto_completa = $_POST['$foto_completa'];
    // Obter outros campos do formulário conforme necessário

    // Criar um novo registro de carro
    criarCarro($marca, $modelo, $ano, $cor, $tracao, $transmissao, $preco, $combustivel, $quilometros, $tipo_uso, $disponibilidade, $foto_completa);

    // Redirecionar de volta para o formulário ou para outra página
    header("Location:listar_carros.php");
    exit();
}
?>
