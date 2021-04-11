<?php

require_once('functions.php');

$generation = [
  [0,0,0,0,0],
  [0,0,0,0,0],
  [0,1,1,1,0],
  [0,0,0,0,0],
  [0,0,0,0,0]
];

$maxGenerations = 10;
for ($generationAge = 0; $generationAge < $maxGenerations; $generationAge++) {
  
  $newGeneration = $generation;

  for ($positionY=0; $positionY < count($newGeneration); $positionY++) {
    for ($positionX=0; $positionX < count($newGeneration[$positionY]); $positionX++) {
      
      $cell = $newGeneration[$positionY][$positionX];
      $neighboursLength = array_sum(getNeighbours($generation, $positionY, $positionX));

      if ($cell && ( $neighboursLength < 2 || $neighboursLength > 3)) {
        $cell = 0;
      } else if (!$cell && ($neighboursLength == 3)) {
        $cell = 1;
      }
      
      $newGeneration[$positionY][$positionX] = $cell;
    }
  }

  $alives = 0;
  forEach ($newGeneration as $alive) {
    $alives += array_sum($alive);
  }

  if (!$alives) {
    echo json_encode($newGeneration) . PHP_EOL;
    echo 'GameOver!!' . PHP_EOL;
    break;
  }
  
  $generation = $newGeneration;
  echo $generationAge . " - " .  json_encode($generation) . PHP_EOL;
}
