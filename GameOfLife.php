<?php

class GameOfLife
{

  private static function generationToArray (Generation $generation, $rowSize, $colSize) 
  {
    
    $rows = [];
    for ($y=0; $y < $rowSize; $y++) {
      $cols = [];
      for ($x=0; $x < $colSize; $x++) {
        $cell = $generation->getCellByPosition($y, $x);
        array_push($cols, intval($cell->isAlive()));
      }
      array_push($rows, $cols);
    }

    return $rows;
  }

  public static function main ($data, $maxGeneration=10) 
  {
    $generation = new Generation();
    $rowsOfData = count($data);
    $colsOfData = count($data[0]);
    
    for ($y=0; $y < $rowsOfData; $y++) {
      for ($x=0; $x < $colsOfData; $x++) {
        $state = $data[$y][$x];
        $cell = new Cell($state, $y, $x);
        $generation->addCell($cell);
      }
    }
    
    //echo json_encode(self::generationToArray($generation, $colsOfData)) . PHP_EOL;

    for ($ageGeneration=0; $ageGeneration < $maxGeneration; $ageGeneration++) {
      
      $newGeneration = clone $generation;
      forEach ($newGeneration->getCells() as $cell) {
        $alivesNeighbours = $cell->getAlivesNeighbours($generation);
        $cell->setState($alivesNeighbours);
      }

      if ($newGeneration->isDie()) {
        echo 'GameOver!!' . PHP_EOL;
        break;
      }

      $generation = clone $newGeneration;
      echo json_encode(self::generationToArray($generation, $rowsOfData, $colsOfData)) . PHP_EOL;
    }

  }

};
