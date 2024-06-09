<?php include 'hearder.php'; ?>

<?php
include "./connection/conexao.php";

// Verifica se o parâmetro id_carro foi passado na URL
if(isset($_GET['id_carro'])) {
    $id_carro = $_GET['id_carro'];

    // Consulta o banco de dados para obter os detalhes do carro com base no id_carro
    $stmt = $pdo->prepare("SELECT * FROM carro WHERE id_carro = :id_carro");
    $stmt->bindParam(':id_carro', $id_carro);
    $stmt->execute();
    
    $carro = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o carro foi encontrado
    if ($carro) {
?>
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Detalhes do Carro</title>
            <!-- Estilos CSS, scripts, etc. -->
        </head>
        <body>
            <div class="bg-white">
                <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                    <h2 class="text-xl font-bold text-gray-900">Detalhes do Carro</h2>
                    <div class="mt-8">
                        <img src="./img/<?php echo $carro['foto_completa']; ?>" alt="Foto do carro" class="h-auto w-full">
                        <p>Marca: <?php echo $carro['marca']; ?></p>
                        <p>Modelo: <?php echo $carro['modelo']; ?></p>
                        <p>Ano: <?php echo $carro['ano']; ?></p>
                        <!-- Adicione mais detalhes conforme necessário -->
                    </div>
                </div>
            </div>
        </body>
        </html>
<?php
    } else {
        echo "Carro não encontrado";
    }
} else {
    echo "ID do carro não especificado";
}
?>



<?php include 'footer.php'?>