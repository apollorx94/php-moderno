<?php

//Recebendo informações do formulario presente no index.php

//$salario = $_POST["salarioBruto"];
//$dependentes = $_POST["numeroDependentes"];

$salario = floatval($_POST["salarioBruto"] ?? 0);
$dependentes = intval($_POST["numeroDependentes"] ?? 0);

//Função responsavel por calcular o desconto do INSS

function calcularINSS(float $salario): array
{
    $faixas = [
        [
            'min' => 0,
            'max' => 1621.00,
            'aliquota' => 0.075
        ],
        [
            'min' => 1621.01,
            'max' => 2902.00,
            'aliquota' => 0.09
        ],
        [
            'min' => 2902.01,
            'max' => 4354.00,
            'aliquota' => 0.12
        ],
        [
            'min' => 4354.01,
            'max' => PHP_FLOAT_MAX,
            'aliquota' => 0.14
        ]
    ];

    $totalINSS = 0;
    $detalhe = [];

    foreach ($faixas as $faixa) {
        if ($salario > $faixa['min']) {
            $valorFaixa = min($salario, $faixa['max']) - $faixa['min'];

            $valorCalculado = $valorFaixa * $faixa['aliquota'];

            $totalINSS += $valorCalculado;

            $detalhes[] = [
                'faixa' => $faixa,
                'base' => $valorFaixa,
                'valor' => $valorCalculado
            ];
        }
    }

    return [
        'total' => round($totalINSS, 2),
        'detalhes' => $detalhe
    ];
}

$inss = calcularINSS($salario);
$salarioLiquido = $salario - $inss['total'];

echo "<p>O valor de desconto do INSS é: R$" . $inss['total'] . "<br>";
echo "<p>Seu salario liquido ficou: R$" . $salarioLiquido . "<br>";
