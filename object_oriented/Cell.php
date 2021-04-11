<?php

class Cell
{

  private $state;
  private $positionY;
  private $positionX;

  public function __construct($state, $positionY, $positionX)
  {
    $this->state = $state;
    $this->positionY = $positionY;
    $this->positionX = $positionX;
  }

  public function setState($alivesNeighbours) {
    $isAlive = $this->isAlive();
    if ($isAlive && ( $alivesNeighbours < 2 || $alivesNeighbours > 3)) {
      $this->state = 0;
    } else if (!$isAlive && ($alivesNeighbours == 3)) {
      $this->state = 1;
    }
  }

  public function isAlive ()
  {
    return $this->state === 1;
  }

  public function isMe($positionY, $positionX)
  {
    return $this->positionY == $positionY 
      && $this->positionX == $positionX; 
  }

  public function getNeighbours(Generation &$generation)
  {
    $neighbours = [];
    for ($y=-1; $y<=1; $y++) {  
      for ($x=-1; $x<=1; $x++) {    
        if (!$x && !$y) {
          continue;
        }
        if ($neighbour = $generation->getCellByPosition($this->positionY + $y, $this->positionX + $x)) {
          array_push($neighbours, $neighbour);
        }
      }
    }
    return $neighbours;
  }

  public function getAlivesNeighbours(Generation &$generation) 
  {
    $alives = 0;
    forEach($this->getNeighbours($generation) as $neighbour) {
      $alives += $neighbour->isAlive();
    }
    return $alives;
  }
}
