<?php 
    include 'crud_roubo_fun.php';

    if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_registro'])){
        $id_registro = $_GET['id_registro'];

        $roubo= obterRouboPorId($id_registro);

        if($id_registro){

        
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

     <!-- Adicione o link para o CSS do Tailwind -->
     <link rel="stylesheet" href="../../src/output.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body class="bg-gray-100 py-12">
    <div class="max-w-md mx-auto bg-white rounded p-5">
        <h1  class="text-2xl mb-5">Atualizar Registo</h1>
        <form action="atualizar_processo.php" method="POST">
        <input type="hidden" name="id_registro" value="<?php echo $id_registro?>">

        <div class="mb-4">
            <label for="id_carro" class="block text-sm font-medium text-gray-700">Id do id_carro</label>
            <input type="number" name="id_carro" id="id_carro" value="<?php echo $roubo['id_carro']; ?>"class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="data_roubo" class="block text-sm font-medium text-gray-700">Data do Roubo</label>
            <input type="date" name="data_roubo" id="data_roubo" value="<?php echo $roubo['data_roubo']; ?>" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="local_roubp" class="block text-sm font-medium text-gray-700">Local do Roubo</label>
            <input type="text" name="local_roubo" id="local_roubo" value="<?php echo $roubo['local_roubo']; ?>" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="descricao_roubo" class="block text-sm font-medium text-gray-700">Descrição do Roubo</label>
            <input type="text" name="descricao_roubo" id="descricao_roubo" value="<?php echo $roubo['descricao_roubo']; ?>" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="status_recuperacao" class="block text-sm font-medium text-gray-700">Status de Recuperação</label>
            <select name="status_recuperacao" id="status_recuperacao" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            <option value="Recuperado" <?php if($roubo['status_recuperacao'] == 'Recuperado') echo 'selected'; ?> >Recuperado</option>
            <option value="Não recuperado" <?php if($roubo['status_recuperacao'] == 'Não recuperado') echo 'selected'; ?> >Não recuperado</option>
            <option value="Em processo" <?php if($roubo['status_recuperacao'] == 'Em processo') echo 'selected'; ?> >Em processo</option>
            </select>
        </div>

        <div class="mb-4"><input type="submit" value="Atualizar" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 cursor-pointer"></div>
        </form>
    </div>
</body>
</html>

<?php 
    }else{
        echo "Registro não econtrado";
    }
}else{
    echo "ID do Registo não especifico";

    }

?>