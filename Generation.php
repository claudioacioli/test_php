<?php

class Generation
{
  private $cells = [];

  public function isDie()
  {
    forEach ($this->cells as $cell) {
      if ($cell->isAlive()) {
        return false;
      }
    }
    return true;
  }

  public function addCell(Cell $cell)
  {
    array_push($this->cells, $cell);
  }

  public function getCells ()
  {
    return $this->cells;
  } 

  public function getCellByPosition($positionY, $positionX)
  {
    forEach ($this->cells as $cell) {
      if ( $cell->isMe($positionY, $positionX)) {
        return $cell;
      }
    }  
    return false;
  }

  function __clone () {
    forEach($this->cells as &$cell) {
      $cell = clone $cell;
    }
  }
}
