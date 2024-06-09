<?php

session_start(); // Inicia a sessão para acessar as variáveis de sessão

// Inclui o arquivo de conexão com o banco de dados
include "./connection/conexao.php";

// Verifica se os IDs do cliente e do carro estão definidos na sessão
if (isset($_SESSION['id_cliente']) && isset($_SESSION['id_carro'])) {
    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se um arquivo foi enviado
        if (isset($_FILES["comprovante"]) && $_FILES["comprovante"]["error"] == UPLOAD_ERR_OK) {
            // Verifica se o arquivo é um PDF e se tem o tamanho correto
            $file_type = mime_content_type($_FILES["comprovante"]["tmp_name"]);
            $file_size = $_FILES["comprovante"]["size"];
            if ($file_type == "application/pdf" && $file_size <= 700000) { // 700 KB em bytes
                // Define o diretório de destino para o upload
                $target_dir = "uploads/";

                // Define o nome do arquivo
                $target_file = $target_dir . basename($_FILES["comprovante"]["name"]);

                // Move o arquivo para o diretório de destino
                if (move_uploaded_file($_FILES["comprovante"]["tmp_name"], $target_file)) {
                    // Prepara a consulta SQL para inserir uma nova compra com o PDF
                    $sql = "INSERT INTO compra (id_cliente, id_carro, comprovativo_compra) VALUES (:id_cliente, :id_carro, :comprovativo_compra)";

                    // Prepara e executa a consulta
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id_cliente', $_SESSION['id_cliente'], PDO::PARAM_INT);
                    $stmt->bindParam(':id_carro', $_SESSION['id_carro'], PDO::PARAM_INT);
                    $stmt->bindParam(':comprovativo_compra', $target_file, PDO::PARAM_STR);
                    $stmt->execute();

                    // Verifica se a compra foi inserida com sucesso
                    if ($stmt->rowCount() > 0) {
                        echo "Compra registrada com sucesso.";
                    } else {
                        echo "Erro ao registrar a compra.";
                    }
                } else {
                    echo "Erro ao enviar o arquivo.";
                }
            } else {
                echo "Por favor, envie um arquivo PDF com no máximo 700KB.";
            }
        } else {
            echo "Por favor, selecione um arquivo para enviar.";
        }
    }
} else {
    echo "ID do cliente ou do carro não encontrado na sessão.";
}

// Verificar se o ID do carro foi passado na URL
if (isset($_GET['id_carro']) && !empty($_GET['id_carro'])) {
    $id_carro = $_GET['id_carro'];

    // Consulta SQL para obter as informações do carro com base no ID
    $sql = "SELECT * FROM carro WHERE id_carro = :id_carro";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_carro', $id_carro, PDO::PARAM_INT);
    $stmt->execute();

    // Verificar se o carro foi encontrado
    if ($stmt->rowCount() > 0) {
        $carro = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Carro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="flex justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Informações do carro -->
        <div class="w-1/2">
            <img src="./img/<?php echo $carro['foto_completa']; ?>" alt="Imagem do carro" width="683" height="532" class="mb-4">
            <h1 class="text-3xl font-semibold mb-4"><?php echo $carro['marca'] . " " . $carro['modelo']; ?></h1>
            <p>Ano: <?php echo $carro['ano']; ?></p>
            <p>Cor: <?php echo $carro['cor']; ?></p>
            <p>Transmissão: <?php echo $carro['transmissao']; ?></p>
            <p>Preço: $<?php echo $carro['preco']; ?></p>
            <!-- Adicione mais informações conforme necessário -->
        </div>

        <!-- Formulário de envio de comprovativo -->
        <div class="w-1/2">
            <h2 class="text-xl font-semibold mb-4">Enviar Comprovativo de Compra</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_carro" value="<?php echo $id_carro; ?>">
                <label for="comprovante" class="block mb-2">Selecione o Comprovativo (PDF):</label>
                <input type="file" id="comprovante" name="comprovante" accept=".pdf" required class="mb-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Enviar</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    } else {
        echo "Carro não encontrado.";
    }
} else {
    echo "ID do carro não fornecido na URL.";
}
?>
