<?php

require_once('functions.php');

$generation = 0;
$state = [
  [0,0,0,0,0],
  [0,0,0,0,0],
  [0,1,1,1,0],
  [0,0,0,0,0],
  [0,0,0,0,0]
];


$maxGenerations = 10;
while ($generation < $maxGenerations) {
  
  $virtual = $state;

  for ($rowIndex=0; $rowIndex < count($virtual); $rowIndex++) {
    for ($cellIndex=0; $cellIndex < count($virtual[0]); $cellIndex++) {
      
      $cell = $virtual[$rowIndex][$cellIndex];

      $neighboursLength = array_sum(getNeighbours($state, $rowIndex, $cellIndex));

      if ($cell && ( $neighboursLength < 2 || $neighboursLength > 3)) {
        $cell = 0;
      } else if (!$cell && ($neighboursLength == 3)) {
        $cell = 1;
      }
      
      $virtual[$rowIndex][$cellIndex] = $cell;
    }
  }

  $aliveCells = 0;
  forEach ($virtual as $value) {
    $aliveCells += array_sum($value);
  }

  if (!$aliveCells) {
    echo json_encode($virtual) . PHP_EOL;
    echo 'GameOver!!' . PHP_EOL;
    break;
  }
  
  $state = $virtual;
  echo $generation . " - " .  json_encode($state) . PHP_EOL;
  $generation++;
}
