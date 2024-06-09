<?php 
include 'crud_compra_fun.php';

if($_SERVER["REQUEST_METHOD"] == 'GET' && ($_GET['delete_id'])){

    $id_compra = $_GET['delete_id'];

    excluirCompra($id_compra);

    header("location:listar_compra.php ");
}

?>