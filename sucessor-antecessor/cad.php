<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numero</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Resultado Final</h1>
    </header>
    <main>
        <?php 
        $numero = $_GET ["numero"];
        $sucessor = $numero + 1;
        $antecessor = $numero - 1;
        echo "<p>
        O numero escolhido foi: $numero<br> 
        O seu ANTECESSOR é: $antecessor<br> 
        O seu SUCESSOR é: $sucessor</p>";
        ?>
        <p><a href="javascript:history.go(-1)">Voltar</a></p>
    </main>
</body>
</html>