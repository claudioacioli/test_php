<?php

function getNeighbours ($state, $rowIndex, $cellIndex)
{
  $neighbours = [];
  for ($i=-1; $i<=1; $i++) {

    if (!array_key_exists($rowIndex + $i, $state))
      continue;

    for ($j=-1; $j<=1; $j++) {
      
      if (
        !array_key_exists($cellIndex + $j, $state[$rowIndex + $i]) 
        || (!$i && !$j)
      )
        continue;

      $neighbour = $state[$rowIndex + $i][$cellIndex + $j];
      array_push($neighbours, $neighbour);
    }
  }
  return $neighbours;
}


