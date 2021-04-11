<?php

require_once('Generation.php');
require_once('Cell.php');
require_once('GameOfLife.php');

$data = [
  [0,0,0,0,0],
  [0,0,0,0,0],
  [0,1,1,1,0],
  [0,0,0,0,0],
  [0,0,0,0,0]
];

GameOfLife::main($data, 10);
