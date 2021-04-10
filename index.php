<?php

$generation = 0;
$state = [
  [0,0,0,0,0],
  [0,0,0,0,0],
  [0,1,1,1,0],
  [0,0,0,0,0],
  [0,0,0,0,0]
];

function getNeighbours ($state, $row_index, $cell_index)
{
  $neighbours = [];
  for ($i=-1; $i<=1; $i++) {

    if (!array_key_exists($row_index + $i, $state))
      continue;

    for ($j=-1; $j<=1; $j++) {
      
      if (
        !array_key_exists($cell_index + $j, $state[$row_index + $i]) 
        || (!$i && !$j)
      )
        continue;

      $neighbour = $state[$row_index + $i][$cell_index + $j];
      array_push($neighbours, $neighbour);
    }
  }
  return $neighbours;
}

$max_generations = 10;
while ($generation < $max_generations) {
  
  $virtual = $state;

  for ($row_index=0; $row_index < count($virtual); $row_index++) {
    for ($cell_index=0; $cell_index < count($virtual[0]); $cell_index++) {
      
      $cell = $virtual[$row_index][$cell_index];
      $neighbours_length = array_sum(getNeighbours($state, $row_index, $cell_index));

      if ($cell && ( $neighbours_length < 2 || $neighbours_length > 3)) {
        $cell = 0;
      } else if (!$cell && ($neighbours_length == 3)) {
        $cell = 1;
      }
      
      $virtual[$row_index][$cell_index] = $cell;
    }
  }

  $alive_cells = 0;
  forEach ($virtual as $value) {
    $alive_cells += array_sum($value);
  }

  if (!$alive_cells) {
    echo json_encode($virtual) . PHP_EOL;
    echo 'GameOver!!' . PHP_EOL;
    break;
  }
  
  $state = $virtual;
  echo $generation . " - " .  json_encode($state) . PHP_EOL;
  $generation++;
}
