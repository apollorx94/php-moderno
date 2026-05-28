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
    <title>Numeros Aleatorios</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Gerando numeros aleatorios com PHP</h1>
        <p>Gerando um numero aleatorio entre os valores <strong>0 e 100:</strong></p>
    </header>
    <section>
        <?php
        // Função que gera numeros aleatorio em PHP
        $numeroAleatorio = random_int(1, 100);
        echo "<p>O numero aleatorio gerado foi o: <strong>$numeroAleatorio</strongo></p>";
        ?>
        <input type="submit" value="Click para gerar novo numero">
    </section>
</body>

</html>