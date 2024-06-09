<?php
session_start(); // Iniciar a sessão para verificar a autenticação do usuário

// Verificar se o usuário está autenticado como cliente
if (!isset($_SESSION['cliente'])) {
    // Se não estiver autenticado, redirecionar para a página de login
    header("Location: ../acesso/login.html");
    exit(); // Parar a execução do script após o redirecionamento
}

// Recuperar o ID do cliente da sessão
$id_cliente = $_SESSION['cliente']['id_cliente'];

// Se o usuário estiver autenticado, continue com o conteúdo da página

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluguel de Carros</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>

<?php include "hearder.php"; ?>

<div class="bg-white">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <h2 class="text-xl font-bold text-gray-900">Carros para Aluguel</h2>

        <!-- Filtros -->
        <div class="mt-8 grid grid-cols-1 gap-y-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <!-- Filtro por tipo de combustível -->
            <div class="flex items-center">
                <label for="filtro_tipo_combustivel" class="mr-2">Tipo de Combustível:</label>
                <select id="filtro_tipo_combustivel" name="filtro_tipo_combustivel" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Todos</option>
                    <option value="Gasolina">Gasolina</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Híbrido">Híbrido</option>
                    <option value="Elétrico">Elétrico</option>
                </select>
            </div>
            <!-- Filtro por tipo de tração -->
            <div class="flex items-center">
                <label for="filtro_tipo_tracao" class="mr-2">Tipo de Tração:</label>
                <select id="filtro_tipo_tracao" name="filtro_tipo_tracao" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Todos</option>
                    <option value="Tração Integral">Tração Integral</option>
                    <option value="Traseira">Traseira</option>
                    <option value="Dianteira">Dianteira</option>
                </select>
            </div>
            <!-- Filtro por tipo de transmissão -->
            <div class="flex items-center">
                <label for="filtro_tipo_transmissao" class="mr-2">Tipo de Transmissão:</label>
                <select id="filtro_tipo_transmissao" name="filtro_tipo_transmissao" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Todos</option>
                    <option value="Automática">Automática</option>
                    <option value="Manual">Manual</option>
                    <option value="Semi-Automática">Semi-Automática</option>
                </select>
            </div>
            <!-- Link de ordenação por preço -->
            <div>
                <label for="ordenar_por_preco" class="mr-2">Ordenar por preço:</label>
                <a href="?ordenar=preco_asc" class="text-gray-700 hover:text-gray-900">Menor primeiro</a> |
                <a href="?ordenar=preco_desc" class="text-gray-700 hover:text-gray-900">Maior primeiro</a>
            </div>
        </div>

        <!-- Grid de carros -->
        <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
            <!-- Loop PHP para exibir os carros -->
            <?php
            include "../connection/conexao.php";

            // Construir a consulta SQL base
            $sql = "SELECT * FROM carro WHERE tipo_uso = 'Aluguel'";

            // Adicionar filtros
            $filtros = [];

            if (!empty($_GET['filtro_tipo_combustivel'])) {
                $filtros[] = "combustivel = '{$_GET['filtro_tipo_combustivel']}'";
            }

            if (!empty($_GET['filtro_tipo_tracao'])) {
                $filtros[] = "tracao = '{$_GET['filtro_tipo_tracao']}'";
            }

            if (!empty($_GET['filtro_tipo_transmissao'])) {
                $filtros[] = "transmissao = '{$_GET['filtro_tipo_transmissao']}'";
            }

            if (!empty($filtros)) {
                $sql .= " AND " . implode(" AND ", $filtros);
            }

            // Adicionar ordenação por preço, se fornecido
            if (!empty($_GET['ordenar'])) {
                if ($_GET['ordenar'] == 'preco_asc') {
                    $sql .= " ORDER BY preco ASC";
                } elseif ($_GET['ordenar'] == 'preco_desc') {
                    $sql .= " ORDER BY preco DESC";
                }
            }

            $compras = $pdo->query($sql);

            if ($compras->rowCount() > 0) {
                foreach ($compras as $comp) {
            ?>
                <div>
                    <!-- Card do carro -->
                    <div class="relative">
                        <div class="relative h-72 w-full overflow-hidden rounded-lg">
                            <img src="../img/<?php echo $comp['foto_completa']; ?>" alt="Imagem do carro" class="h-full w-full object-cover object-center">
                        </div>
                        <div class="relative mt-4">
                            <h3 class="text-sm font-medium text-gray-900"><?php echo $comp['marca'] . " " . $comp['modelo']; ?></h3>
                            <p class="mt-1 text-sm text-gray-500"><?php echo $comp['ano']; ?></p>
                        </div>
                        <div class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4">
                            <div aria-hidden="true" class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
                            <p class="relative text-lg font-semibold text-white"><?php echo number_format($comp['preco'], 2); ?>kz</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <!-- Botão de aluguel -->
                        <form action="alugar_carro.php" method="post">
                            <input type="hidden" name="id_carro" value="<?php echo $comp['id_carro']; ?>">
                            <button type="submit" class="relative flex items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200">Alugar</button>
                        </form>
                        <!-- Link para detalhes -->
                        <a href="detalhes_carro.php?id_carro=<?php echo $comp['id_carro']; ?>" class="ml-4 text-sm font-medium text-gray-900 underline hover:text-gray-700">Detalhes</a>
                    </div>
                </div>
            <?php
                }
            } else {
                echo "Nenhum carro encontrado";
            }
            ?>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>

</body>
</html>
