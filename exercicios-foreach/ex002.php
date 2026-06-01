<?php
// Ex 2 — Filtro simples: Cria um array com 6 números misturados (positivos e negativos). Percorre e imprime só os positivos.

$listaNumeros = [1, 4, -6, 10, -11, -16, 13];
$contador = 1;

foreach ($listaNumeros as $lista) {
    if ($lista >= 0) {
        echo $contador . "º:" . $lista . "\n";
        $contador = $contador + 1;
    }
}
