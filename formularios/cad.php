<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Resposta do Formulario</title>
</head>
<body>
    <header>
        <h1>Recebendo os dados do formulario!</h1>
        <p>Abaixo o que foi recebido via formulario</p>
    </header>
    <main>
        <?php
        $nome = $_GET["nome"]; //?? "sem nome";
        $sobrenome = $_GET["sobrenome"] ;//?? "sem sobrenome";
        echo "Ola $nome $sobrenome, bem vindo ao meu site!";
        ?>
        <p><a href="javascript:history.go(-1)">Voltar a pagina inicial</a></p>
    </main>
</body>
</html>