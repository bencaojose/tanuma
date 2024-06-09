<?php
include 'crud_car_fun.php';

// Verifica se a requisição é do tipo GET e se o parâmetro delete_id está presente
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_id'])) {
    // Obtém o ID do carro a ser excluído
    $id_carro = $_GET['delete_id'];

    // Chama a função para excluir o carro
    excluirCarro($id_carro);

    // Redireciona de volta para a página que lista os carros
    header("Location: listar_carros.php");
    exit(); // Importante para evitar execução adicional de código após o redirecionamento
}
?>
