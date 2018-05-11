<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$nb = array(array(-1, 0), array(0, -1), array(0, +1), array(+1, 0));

$input = fopen("input", "r");
$output = fopen("output", "w");

$T = intval(fgets($input));

for ($t=1; $t <= $T; $t++) {
  
  list($H, $W) = fscanf($input, "%d %d");
  
  $alts = array();
  
  for ($h=0; $h<$H; $h++) {
    $line = fgets($input);
    $alts[$h] = split(" ", $line);
  }
  
  $flows = array();
  
  for ($h=0; $h<$H; $h++) {
    for ($w=0; $w<$W; $w++) {
      $start = $h*$W + $w;
      
      if (array_key_exists($start, $flows)) continue;
        
      // where?
      $min = intval($alts[$h][$w]);      
      $finish = $start;
      
      foreach ($nb as $c) {
        
        $y = $h + $c[0];
        $x = $w + $c[1];
        
        if ($y < 0) continue;
        if ($y >= $H) continue;
        if ($x < 0) continue;
        if ($x >= $W) continue;
        
        if (intval($alts[$y][$x]) < $min) {
          $min = intval($alts[$y][$x]);
          $finish = $y*$W + $x;
        }
        
      }
      
      $flows[$start] = $finish;
    }
  }
  
  //var_dump($flows);
  
  $bassins = array();
  $b = 0;
  
  // need to put first vertex in path
  // start with the most north west
  for ($h=0; $h<$H; $h++) {
    for ($w=0; $w<$W; $w++) {
      $vertex = $h*$W + $w;
      if (array_key_exists($vertex, $bassins)) continue;
      
      $b++;
       
      $path = array();
      
      $p = 0;
      
      $path[$p] = $vertex;
      $bassins[$vertex] = $b;

      // go deep
      while (true) {
        
        $p1 = $p;
        
        if (!empty($flows[$vertex]) && empty($bassins[$flows[$vertex]]) && ($flows[$vertex] != $vertex)) {
          $vertex = $flows[$vertex];
          $p++;
          $path[$p] = $vertex;
          $bassins[$vertex] = $b;
        } else {
          foreach ($flows as $s => $f) {
            if (($f == $vertex) && empty($bassins[$s]) && ($s != $f)) {
              $vertex = $s;
              $p++;
              $path[$p] = $vertex;
              $bassins[$vertex] = $b;
              break;
            }
          }
        }
        
        if ($p1 == $p) {
          $p--;
          if ($p<0) break;
          $vertex = $path[$p];
        }
        
      }
      
    }
  }

  fprintf($output, "Case #%d:\r\n", $t);  
  for ($h=0; $h<$H; $h++) {
    for ($w=0; $w<$W; $w++) {
      $v = $h*$W + $w;
      fwrite($output, chr(96+$bassins[$v]));
      if ($w< $W-1) fwrite($output, " ");
    }
    fwrite($output, "\r\n");
  }
}

fclose($input);
fclose($output);