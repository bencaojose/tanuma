<?php
session_start();
include "../connection/conexao.php";

// Verifica se o usuário está autenticado
if (!isset($_SESSION['cliente'])) {
    // Se não estiver autenticado, redirecionar para a página de login
    header("Location: ../acesso/login.html");
    exit(); // Parar a execução do script após o redirecionamento
}

if (isset($_FILES['comprovativo_pagamento'])) {
    // Verifica se o arquivo é um PDF e seu tamanho não excede 700KB
    if ($_FILES['comprovativo_pagamento']['error'] === 0 && $_FILES['comprovativo_pagamento']['type'] === 'application/pdf' && $_FILES['comprovativo_pagamento']['size'] <= 700000) {
        // Verifica se a pasta 'uploads' existe, se não, cria a pasta
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move o arquivo para uma pasta de destino
        $comprovativoPath = $uploadDir . basename($_FILES['comprovativo_pagamento']['name']);
        if (move_uploaded_file($_FILES['comprovativo_pagamento']['tmp_name'], $comprovativoPath)) {
            // Obtém o ID do cliente da sessão
            $id_cliente = $_SESSION['cliente']['id_cliente'];

            // Obtém o ID do carro a partir do formulário
            $id_carro = $_POST['id_carro']; // O ID do carro agora é enviado pelo formulário

            // Insere os dados na tabela de compras dentro deste bloco, após verificar os requisitos
            $stmt = $pdo->prepare("INSERT INTO compra (id_cliente, id_carro, comprovativo_compra) VALUES (?, ?, ?)");
            $stmt->execute([$id_cliente, $id_carro, $comprovativoPath]);

            echo "Compra realizada com sucesso!";
        } else {
            echo "Erro ao mover o arquivo para o destino.";
        }
    } else {
        echo "Erro: O arquivo deve ser um PDF com tamanho máximo de 700KB.";
    }
} else {
    echo "Por favor, envie o comprovativo de pagamento.";
}
?>
