<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Descontos</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Calculadora de Salario</h1>
        <p>Essa calculadora tem como objetivo calcular o salario com descontos do INSS e IRRF respectivamente</p>
    </header>
    <section>
        <form id="formSalario">
            <label for="salario">Digite seu salario Bruto:</label>
            <input type="text" name="salarioBruto" id="idSalarioBruto" placeholder="R$">
            <label for="dependente">Digite o numero de dependentes:</label>
            <input type="text" name="numeroDependentes" id="idnumeroDependentes" placeholder="0">
            <input type="submit" value="Calcular Descontos">
        </form>
    </section>

    <!-- RESULTADO do Calculo-->
    <section id="resultado"></section>

    <script>
        const formulario = document.getElementById('formSalario');

        formulario.addEventListener('submit', function(e) {

            // Impede recarregar a página
            e.preventDefault();

            // Captura os dados do formulário
            let dadosFormulario = new FormData(formulario);

            // Envia para o PHP
            fetch('cad.php', {
                    method: 'POST',
                    body: dadosFormulario
                })

                .then(response => response.text())

                .then(data => {

                    // Exibe o retorno abaixo do formulário
                    document.getElementById('resultado').innerHTML = data;

                })

                .catch(error => {

                    console.error('Erro:', error);

                });

        });
    </script>

</body>

</html>