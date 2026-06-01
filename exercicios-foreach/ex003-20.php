<?php

$produtos = [
    'maçã'    => 5.80,
    'banana'  => 6.48,
    'laranja' => 7.46,
    'mamão'   => 2.99,
    'limão'   => 5.97
];
$soma = 0;

foreach ($produtos as $nome => $preco) {
    echo $nome . ': R$' . $preco . "\n";
    $soma = $soma + $preco;
}

echo 'Valor total é: ' . $soma . "\n";