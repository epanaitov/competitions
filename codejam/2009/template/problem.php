<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$engines = array();

$input = fopen("input", "r");

$N = fgets($input);

for ($i=1; $i <= $N; $i++) {
  $S = fgets($input);
  
  for ($j =1; $j <= $S; $j++) {
    
    $engine = fgets($input);
    
    $engines[$engine] = $engine;
    
  }
  
}

fclose($input);

// bla bla

$output = fopen("output", "w");
fprintf($output, "%d: %d", $i, $j);

fclose($output);