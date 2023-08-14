<!DOCTYPE html>
<html>
<head>
  <title>Dados Recebidos</title>
</head>
<body>
  <h1>Dados Recebidos</h1>
  <div>
    <?php
    // Verificar se o arquivo data.json existe
    if (file_exists('data.json')) {
      // Ler o conteúdo do arquivo data.json
      $savedData = file_get_contents('data.json');

      // Exibir os dados salvos
      if (!empty($savedData)) {
        echo "Dados salvos:\n";
        echo nl2br($savedData); // Para manter as quebras de linha
      } else {
        echo "";
      }
    } else {
      echo "Nenhum dado salvo ainda.";
    }
    ?>
  </div>
</body>
</html>
