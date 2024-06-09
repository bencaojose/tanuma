<?php
include 'crud_car_fun.php';

// Verificar se o ID do carro foi passado na URL
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_carro'])) {
    $id_carro = $_GET['id_carro'];
    
    // Obter dados do carro com base no ID
    $carro = obterCarroPorId($id_carro);
    
    // Verificar se o carro foi encontrado
    if ($carro) {
        // Dados do carro encontrados, exibir o formulário de atualização
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Carro</title>
    <!-- Adicione o link para o CSS do Tailwind -->
    <link rel="stylesheet" href="../../src/output.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 py-12">
    <div class="max-w-md mx-auto bg-white rounded p-5">
        <h1 class="text-2xl mb-5">Atualizar Carro</h1>
        <form action="processar_atualizacao.php" method="POST">

            <input type="hidden" name="id_carro" value="<?php echo $id_carro; ?>">

            <div class="mb-4">
                <label for="marca" class="block text-sm font-medium text-gray-700">Marca:</label>
                <input type="text" id="marca" name="marca" value="<?php echo $carro['marca']; ?>" required required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>
    

        <div class="mb-4">
            <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo:</label>
            <input type="text" id="modelo" name="modelo" value="<?php echo $carro['modelo']; ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>

        <div class="mb-5">
            <label for="ano"  class="block text-sm font-medium text-gray-700">Ano:</label>
            <input type="number" id="ano" name="ano" value="<?php echo $carro['ano']; ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div> 

        <div class="mb-4">
            <label for="cor"  class="block text-sm font-medium text-gray-700">Cor:</label>
            <input type="text" id="cor" name="cor" value="<?php echo $carro['cor']; ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="tracao"  class="block text-sm font-medium text-gray-700">Tração:</label>
            <select id="tracao" name="tracao" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                <option value="Tração Integral" <?php if ($carro['tracao'] == 'Tração Integral') echo 'selected'; ?>>Tração Integral</option>
                <option value="Traseira" <?php if ($carro['tracao'] == 'Traseira') echo 'selected'; ?>>Traseira</option>
                <option value="Dianteira" <?php if ($carro['tracao'] == 'Dianteira') echo 'selected'; ?>>Dianteira</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="transmissao"  class="block text-sm font-medium text-gray-700">Transmissão:</label>
            <select id="transmissao" name="transmissao" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                <option value="Automática" <?php if ($carro['transmissao'] == 'Automática') echo 'selected'; ?>>Automática</option>
                <option value="Manual" <?php if ($carro['transmissao'] == 'Manual') echo 'selected'; ?>>Manual</option>
                <option value="Semi-Automática" <?php if ($carro['transmissao'] == 'Semi-Automática') echo 'selected'; ?>>Semi-Automática</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="preco"  class="block text-sm font-medium text-gray-700">Preço:</label>
            <input type="number" id="preco" name="preco" value="<?php echo $carro['preco']; ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="combustivel"  class="block text-sm font-medium text-gray-700">Combustível:</label>
            <select id="combustivel" name="combustivel" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                <option value="Gasolina" <?php if ($carro['combustivel'] == 'Gasolina') echo 'selected'; ?>>Gasolina</option>
                <option value="Diesel" <?php if ($carro['combustivel'] == 'Diesel') echo 'selected'; ?>>Diesel</option>
                <option value="Híbrido" <?php if ($carro['combustivel'] == 'Híbrido') echo 'selected'; ?>>Híbrido</option>
                <option value="Elétrico" <?php if ($carro['combustivel'] == 'Elétrico') echo 'selected'; ?>>Elétrico</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="quilometros"  class="block text-sm font-medium text-gray-700">Quilometragem (km):</label>
            <input type="number" id="quilometros" name="quilometros" value="<?php echo $carro['quilometros']; ?>" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <label for="tipo_uso"  class="block text-sm font-medium text-gray-700">Tipo de Uso:</label>
            <select id="tipo_uso" name="tipo_uso" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                <option value="Compra" <?php if ($carro['tipo_uso'] == 'Compra') echo 'selected'; ?>>Compra</option>
                <option value="Aluguel" <?php if ($carro['tipo_uso'] == 'Aluguel') echo 'selected'; ?>>Aluguel</option>
                <option value="Registo de Roubo" <?php if ($carro['tipo_uso'] == 'Registo de Roubo') echo 'selected'; ?>>Registo de Roubo</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="disponibilidade"  class="block text-sm font-medium text-gray-700">Disponibilidade:</label>
            <input type="checkbox" id="disponibilidade" name="disponibilidade" <?php if ($carro['disponibilidade']) echo 'checked'; ?> class="mt-1">
        </div>

        <div class="mb-4">
            <label for="foto_completa"  class="block text-sm font-medium text-gray-700">URL da Foto:</label>
            <input type="text" id="foto_completa" name="foto_completa" value="<?php echo $carro['foto_completa']; ?>" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>

        <div class="mb-4">
            <input type="submit" value="Atualizar"  class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 cursor-pointer">
        </div>
    </form>
    </div>
</body>
</html>
<?php
    } else {
        echo "Carro não encontrado.";
    }
} else {
    echo "ID do carro não especificado.";
}
?>
