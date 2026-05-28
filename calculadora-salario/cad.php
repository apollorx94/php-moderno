<?php

//Recebendo informações do formulario presente no index.php

$salario = floatval($_POST["salarioBruto"] ?? 0);
$dependentes = intval($_POST["numeroDependentes"] ?? 0);

//Função responsavel por calcular o desconto do INSS

function calcularINSS(float $salario): array
{

    // Teto previdenciário oficial
    $tetoINSS = 8475.55;

    // Limita salário ao teto
    $salarioBase = min($salario, $tetoINSS);

    $faixas = [

        [
            'max' => 1621.00,
            'aliquota' => 0.075
        ],

        [
            'max' => 2902.00,
            'aliquota' => 0.09
        ],

        [
            'max' => 4354.00,
            'aliquota' => 0.12
        ],

        [
            'max' => $tetoINSS,
            'aliquota' => 0.14
        ]
    ];

    $totalINSS = 0;
    $faixaAnterior = 0;
    $detalhes = [];

    foreach ($faixas as $faixa) {

        if ($salarioBase > $faixaAnterior) {

            $baseFaixa = min($salarioBase, $faixa['max']) - $faixaAnterior;

            $valorFaixa =
                $baseFaixa * $faixa['aliquota'];

            $totalINSS += $valorFaixa;

            $detalhes[] = [

                'base' => round($baseFaixa, 2),

                'aliquota' => $faixa['aliquota'],

                'valor' => round($valorFaixa, 2)
            ];
        }

        $faixaAnterior = $faixa['max'];
    }

    return [

        'total' => round($totalINSS, 2),

        'detalhes' => $detalhes
    ];
}

//Função de calcula o IRRF 

function calcularIRRF(
    float $salarioBruto,
    float $inss,
    int $dependentes = 0
): array {

    $deducaoDependente = 189.59;

    // Base de cálculo
    $baseCalculo =
        $salarioBruto
        - $inss
        - ($dependentes * $deducaoDependente);

    // Tabela oficial
    $faixas = [

        [
            'max' => 2259.20,
            'aliquota' => 0,
            'deducao' => 0
        ],

        [
            'max' => 2826.65,
            'aliquota' => 0.075,
            'deducao' => 169.44
        ],

        [
            'max' => 3751.05,
            'aliquota' => 0.15,
            'deducao' => 381.44
        ],

        [
            'max' => 4664.68,
            'aliquota' => 0.225,
            'deducao' => 662.77
        ],

        [
            'max' => PHP_FLOAT_MAX,
            'aliquota' => 0.275,
            'deducao' => 896.00
        ]
    ];

    $irNormal = 0;
    $aliquota = 0;
    $deducao = 0;

    // Calcula IR tradicional
    foreach ($faixas as $faixa) {

        if ($baseCalculo <= $faixa['max']) {

            $aliquota = $faixa['aliquota'];
            $deducao = $faixa['deducao'];

            $irNormal =
                ($baseCalculo * $aliquota)
                - $deducao;

            break;
        }
    }

    // Evita negativo
    if ($irNormal < 0) {
        $irNormal = 0;
    }

    // =========================
    // NOVA REGRA DO REDUTOR
    // =========================

    $redutor = 0;

    // Faixa até 5 mil
    if ($baseCalculo <= 5000) {

        $redutor = min($irNormal, 312.89);
    }

    // Faixa intermediária
    elseif ($baseCalculo <= 7350) {

        $redutor =
            978.62 - (0.133145 * $baseCalculo);

        // Garante mínimo zero
        if ($redutor < 0) {
            $redutor = 0;
        }

        // Nunca reduz mais que o imposto
        if ($redutor > $irNormal) {
            $redutor = $irNormal;
        }
    }

    // IR final
    $irFinal = $irNormal - $redutor;

    return [

        'base_calculo' => round($baseCalculo, 2),

        'aliquota' => $aliquota,

        'deducao' => $deducao,

        'ir_normal' => round($irNormal, 2),

        'redutor' => round($redutor, 2),

        'valor' => round($irFinal, 2)
    ];
}

//Chamando função INSS
$inss = calcularINSS($salario);

//Chamando função IRRF, depois de calcular desconto INSS
$irrf = calcularIRRF(salarioBruto: $salario, inss: $inss['total'], dependentes: $dependentes);

//Salario Liquido calculado apenas INSS
$salarioLiquido = $salario - $inss['total'] - $irrf['valor'];

echo "<p>O valor de desconto do INSS é: R$" . $inss['total'] . "<br>";
echo "<p>Valor do imposto de renda: R$" . $irrf['valor'] . "<br>";
echo "<p>Seu salario liquido ficou: R$" . $salarioLiquido . "<br>";
