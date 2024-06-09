<?php
include 'crud_car_fun.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_carro = $_POST['id_carro'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $cor = $_POST['cor'];
    $tracao = $_POST['tracao'];
    $transmissao = $_POST['transmissao'];
    $preco = $_POST['preco'];
    $combustivel = $_POST['combustivel'];
    $quilometros = $_POST['quilometros'];
    $tipo_uso = $_POST['tipo_uso'];
    $disponibilidade = $_POST['disponibilidade'];
    $foto_completa = $_POST['foto_completa'];

    // Obtenha outros campos conforme necessário
    
    atualizarCarro($id_carro, $marca, $modelo, $ano, $cor, $tracao, $transmissao, $preco, $combustivel, $quilometros, $tipo_uso, $disponibilidade, $foto_completa );
    // Redirecionar ou exibir uma mensagem de sucesso
    header("Location:listar_carros.php");
    exit();
}
?>
