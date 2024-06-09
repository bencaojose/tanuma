<?php 
include'crud_roubo_fun.php';

if($_SERVER["REQUEST_METHOD"]==  "POST" ){

    $id_carro = $_POST['id_carro'];
    $data_roubo = $_POST['data_roubo'];
    $local_roubo = $_POST['local_roubo'];
    $descricao_roubo = $_POST['descricao_roubo'];
    $status_recuperacao = $_POST['status_recuperacao'];

    criaRoubo($id_carro, $data_roubo, $local_roubo, $descricao_roubo, $status_recuperacao);

    header("location:listar_registro.php");
    exit();

}

?>