<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Conversor de Moedas</title>
</head>

<body>
    <header>
        <h1>Conversor de Moedas Versão 1.0</h1>
    </header>
    <section>
        <?php
        $valorReais = $_GET["valorReais"];
        //Verifico o valor recebido e caso tenha virgulas (,) eu troco por ponto (.) para nao quebrar o codigo!
        $valorReais = str_replace(',', '.', $valorReais);
        $valorReais = (float) $valorReais;

        //Sigo com a execução para fazer a conversar de REAIS para DOLARES
        $cotacaoDolar = 5.08;
        $conversaoDolar = $valorReais / $cotacaoDolar;
        $valorFormatado = number_format($conversaoDolar, 2, ',');
        echo "Seus R$ $valorReais, equivalem a US$ $valorFormatado<br>";
        echo "<br>";
        echo "Utilizamos uma cotação fixa de <strong>R$$cotacaoDolar";
        ?>
        <p><a href="javascript:history.go(-1)">Converter outro valor</a></p>
    </section>
</body>

</html>