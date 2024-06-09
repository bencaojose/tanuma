<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>
    
<?php include "hearder.php"; ?>

<div class="bg-white mt-8 mx-4 sm:mx-auto sm:max-w-7xl"> <!-- Adiciona margem à esquerda e à direita -->
    <h2 class="text-xl font-bold text-gray-900 uppercase">CARROS À VENDA</h2> <!-- Transforma o texto em maiúsculas -->
    <div class="overflow-hidden px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
        <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 lg:gap-x-8">
            <?php
            include "../connection/conexao.php";

            $sql = "SELECT r.*, c.marca, c.modelo, c.foto_completa
            FROM registro_roubo r
            INNER JOIN carro c ON r.id_carro = c.id_carro
            WHERE r.status_recuperacao != 'Recuperado'";

            $result = $pdo->query($sql);

            if ($result->rowCount() > 0) {
                foreach ($result as $row) {
                    ?>
                    <div class="group text-sm">
                        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                            <img src="../img/<?php echo $row['foto_completa']; ?>" alt="Imagem do carro" class="h-full w-full object-cover object-center">
                        </div>
                        <h3 class="mt-4 font-medium text-gray-900"><?php echo $row['marca']; ?></h3>
                        <p class="italic text-gray-500"><?php echo $row['modelo']; ?></p>
                        <p class="italic text-gray-500"><?php echo $row['data_roubo']; ?></p>
                        <p class="italic text-gray-500"><?php echo $row['local_roubo']; ?></p>
                        <p class="mt-2 font-medium text-gray-900"><?php echo $row['status_recuperacao']; ?></p>
                    </div>
                    <?php
                }
            } else {
                ?>
                <p class="text-gray-900">Nenhum produto encontrado.</p>
                <?php
            }
            ?>
        </div>
    </div>
</div>


<?php include "footer.php"; ?>

</body>
</html>