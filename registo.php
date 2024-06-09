<?php include "hearder.php";?>

<div class="bg-white">
  <div class="mx-auto max-w-7xl overflow-hidden px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
    <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 lg:gap-x-8">
      
      <?php
      // Inclui o arquivo de conexão
      include "./connection/conexao.php";

      // Consulta SQL para obter os registros de roubo com detalhes do carro
      $sql = "SELECT r.*, c.marca, c.modelo, c.foto_completa
      FROM registro_roubo r
      INNER JOIN carro c ON r.id_carro = c.id_carro
      WHERE r.status_recuperacao != 'Recuperado'"; // Modificação aqui para selecionar apenas carros não recuperados

      $result = $pdo->query($sql); 

      // Verifica se há registros retornados pela consulta
      if ($result->rowCount() > 0) { // Usamos rowCount() para contar as linhas no resultado
          // Loop através de cada linha de dados
          foreach ($result as $row) {
      ?>
          <div class="group text-sm">
            <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
              <img src="./img/<?php echo $row['foto_completa']; ?>" alt="" class="h-full w-full object-cover object-center">
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
          echo "Nenhum produto encontrado.";
      }
      ?>

      <!-- Mais produtos... -->
    </div>
  </div>
</div>

<?php include "footer.php";  ?> 
