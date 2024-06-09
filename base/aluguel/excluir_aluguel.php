<?php 
include 'crud_aluguer_fun.php';

if($_SERVER["REQUEST_METHOD"] == 'GET' && ($_GET['delete_id'])){

    $id_aluguel = $_GET['delete_id'];

    excluirAluguer($id_aluguel);

    header("location: listar_aluguel.php");
}

?>