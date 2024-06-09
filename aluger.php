<?php include "hearder.php";?>

<div class="bg-white">
  <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
    <h2 class="text-xl font-bold text-gray-900">Customers also bought</h2>  

    <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">

    <?php
    include "./connection/conexao.php";

    $sql = "SELECT * FROM carro WHERE tipo_uso = 'Aluguel'";

    $compras = $pdo->query($sql);

    if ($compras->rowCount() > 0) {
        foreach ($compras as $comp) {
    ?>
        <div>
            <div class="relative">
                <div class="relative h-72 w-full overflow-hidden rounded-lg">
                    <img src="img/<?php echo $comp['foto_completa']; ?>" alt="Front of zip tote bag with white canvas, black canvas straps and handle, and black zipper pulls." class="h-full w-full object-cover object-center">
                </div>
                <div class="relative mt-4">
                    <h3 class="text-sm font-medium text-gray-900">Zip Tote Basket</h3>
                    <p class="mt-1 text-sm text-gray-500">White and black</p>
                </div>
                <div class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4">
                    <div aria-hidden="true" class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
                    <p class="relative text-lg font-semibold text-white">$140</p>
                </div>
            </div>
            <div class="mt-6">
                <a href="#" class="relative flex items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200">Add to bag<span class="sr-only">, Zip Tote Basket</span></a>
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


<?php include "footer.php";  ?> 
