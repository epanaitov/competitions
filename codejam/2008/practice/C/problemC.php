<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$input = fopen("input", "r");
$output = fopen("output", "w");

$N = fgets($input);

$matrix = array();

for ($d=1; $d<=100; $d++) $matrix[$d][1] = $d;
for ($b=1; $b<=100; $b++) $matrix[1][$b] = 1;
for ($b=2; $b<=100; $b++) $matrix[2][$b] = 3;

for ($d=3; $d<=100; $d++) {
  for ($b=2; $b<=$d; $b++) {
    $f = 0;
    if (empty($matrix[$d-1][$b])) $f = $matrix[$d-1][$b-1] + $matrix[$d-1][$b-1] + 1;
    else $f = $matrix[$d-1][$b] + $matrix[$d-1][$b-1] + 1; /// needs mathematical proof
    
    //if ($f > 4294967295) $matrix[$d][$b] = -1;
    //else 
    $matrix[$d][$b] = $f;
  }
}

var_dump($matrix);

for ($j=1; $j <= $N; $j++) {
  
  $f = $d = $b = 0;
  list($f, $d, $b) = fscanf($input, "%d %d %d");
  
  $f1 = $matrix[$d][$b];
  if ($f1 > 4294967295) $f1 = -1;
  
  for ($d1 = 1; $d1<=100; $d1++) {
    if (empty($matrix[$d1][$b])) {
      $b2 = $b;
      while (empty($matrix[$d1][$b2])) {
        $b2--;
      }
      $f2 = $matrix[$d1][$b2];
    } else {
      $f2 = $matrix[$d1][$b];
    }
    if ($f2 >= $f) break;
  }
  
  for ($b1=1; $b1 <= 100; $b1++) {
    if (empty($matrix[$d][$b1])) {
      $d2 = $d;
      while (empty($matrix[$d2][$b1])) {
        $d2--;
      }
      $f2 = $matrix[$d2][$b1];
    } else {
      $f2 = $matrix[$d][$b1];
    }
    if ($f2 >= $f) break;
  } 
  
  fwrite($output, sprintf("Case #%d: %d %d %d\r\n", $j, $f1, $d1, $b1));
}

fclose($input);
fclose($output);