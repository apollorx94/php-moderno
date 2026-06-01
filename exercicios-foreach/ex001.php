<?php
// Ex 1 — Lista de tarefas: Cria um array com 5 tarefas do dia. Percorre e imprime numerado:

$listaTarefas = ['Acordar', 'Levantar', 'Tomar Banho', 'Escovar os Dentes', 'Por a roupa'];
$contador = 1;

foreach ($listaTarefas as $lista) {

    echo $contador . "º:" . $lista . "\n";
    $contador++;
}
