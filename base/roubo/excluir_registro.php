<?php 
include 'crud_roubo_fun.php';

    if($_SERVER["REQUEST_METHOD"] =='GET' && ($_GET['delete_id'])){

        $id_registro = $_GET['delete_id'];

        excluirRoubo($id_registro);

        header("location: listar_registro.php");
    }

?>