<?php

function getNeighbours ($generation, $positionY, $positionX)
{
  $neighbours = [];
  for ($y=-1; $y<=1; $y++) {

    $neighbourPositionY = $positionY + $y;
    if (!array_key_exists($neighbourPositionY, $generation))
      continue;

    for ($x=-1; $x<=1; $x++) {

      $neighbourPositionX = $positionX + $x;
      if (
        !array_key_exists($neighbourPositionX, $generation[$neighbourPositionY])
        || (!$x && !$y)
      )
        continue;

      $neighbour = $generation[$neighbourPositionY][$neighbourPositionX];
      array_push($neighbours, $neighbour);
    }
  }
  return $neighbours;
}


