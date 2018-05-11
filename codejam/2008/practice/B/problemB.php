<?php

/**
 * Use PHP 5.2.6 to run $this
 */

define("NORTH", 1);
define("SOUTH", 2);
define("WEST", 4);
define("EAST", 8);

$input = fopen("input", "r");
$output = fopen("output", "w");

$N = fgets($input);

for ($j=1; $j <= $N; $j++) {
  list($enex, $exen) = fscanf($input, "%s %s");
  
  $maze = array();
  
  $x = 0;
  $y = 0;
  
  $dir = 180;
  
  $maxx = 0;
  $minx = 0;
  
  $miny = 0;
  
  for ($i=0; $i < strlen($enex); $i++) {
    switch ($enex{$i}) {
      case "W":
        if (empty($maze[$x][$y])) $maze[$x][$y] = 0;
        switch ($dir) {
          case 0:
            $maze[$x][$y] = $maze[$x][$y] | NORTH; 
            $y++;
            $maze[$x][$y] = $maze[$x][$y] | SOUTH;
          break;
          case 90:
            $maze[$x][$y] = $maze[$x][$y] | EAST;
            $x++;
            $maze[$x][$y] = $maze[$x][$y] | WEST;
          break;
          case 180:
            $maze[$x][$y] = $maze[$x][$y] | SOUTH;
            $y--;
            $maze[$x][$y] = $maze[$x][$y] | NORTH;
          break;
          case 270:
            $maze[$x][$y] = $maze[$x][$y] | WEST;
            $x--;
            $maze[$x][$y] = $maze[$x][$y] | EAST;
          break;
        }
        if ($x > $maxx) $maxx = $x;
        if ($x < $minx) $minx = $x;
        if ($y < $miny) $miny = $y;
      break;
        
      case "R":
        $dir+= 90;
        if ($dir >= 360) $dir-= 360;
      break;
        
      case "L":
        $dir-= 90;
        if ($dir < 0) $dir+= 360;
      break;  
    }
  }
  
  switch ($dir) {
    case 180:
      $miny++;
    break; 
    case 90:
      $maxx--;
    break;
    case 270:
      $minx++;
    break;      
  }
  

  $dir+= 180;
  if ($dir >= 360) $dir-= 360;
  
  for ($i=0; $i < strlen($exen); $i++) {
    switch ($exen{$i}) {
      case "W":
        if (empty($maze[$x][$y])) $maze[$x][$y] = 0;
        switch ($dir) {
          case 0:
            $maze[$x][$y] = $maze[$x][$y] | NORTH; 
            $y++;
            $maze[$x][$y] = $maze[$x][$y] | SOUTH;
          break;
          case 90:
            $maze[$x][$y] = $maze[$x][$y] | EAST;
            $x++;
            $maze[$x][$y] = $maze[$x][$y] | WEST;
          break;
          case 180:
            $maze[$x][$y] = $maze[$x][$y] | SOUTH;
            $y--;
            $maze[$x][$y] = $maze[$x][$y] | NORTH;
          break;
          case 270:
            $maze[$x][$y] = $maze[$x][$y] | WEST;
            $x--;
            $maze[$x][$y] = $maze[$x][$y] | EAST;
          break;
        }
        if ($x > $maxx) $maxx = $x;
        if ($x < $minx) $minx = $x;
        if ($y < $miny) $miny = $y;
      break;
        
      case "R":
        $dir+= 90;
        if ($dir >= 360) $dir-= 360;
      break;
        
      case "L":
        $dir-= 90;
        if ($dir < 0) $dir+= 360;
      break;  
    }
  }
  
  fwrite($output, sprintf("Case #%d:\r\n", $j));
  for ($y = -1; $y>=$miny; $y--) {
    for ($x = $minx; $x<= $maxx; $x++) {
      fwrite($output, sprintf("%x", $maze[$x][$y]));  
    }
    fwrite($output, "\r\n");
  }
}

fclose($input);
fclose($output);