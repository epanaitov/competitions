<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$input = fopen("input", "r");
$output = fopen("output", "w");

$N = intval(fgets($input));

$m = array();

$happy = fopen("happy", "r");
for ($i=2; $i<11; $i++) {
  $line = split(" ",fgets($happy));
  $m[array_shift($line)] = $line;
}
fclose($happy);

for ($X=1; $X <= $N; $X++) {
  
  $line = split(" ",fgets($input));
  
  $bases = array();
  
  foreach ($line as $item) {
    if (intval($item)) $bases[] = intval($item); 
  }
  
  if (count($bases) == 1) {
    $answer = $m[$bases[0]][0];
    fwrite($output, sprintf("Case #%d: %d\r\n", $X, $answer));
    continue;
  }
  
  sort($bases);
  
  $bases = array_reverse($bases);
  
  $base = $bases[0];
  
  $p = 0;
  
  do {
  
    $h = $m[$base][$p];
    
    $forall = true;
    
    for ($b=1; $b<count($bases); $b++) {
      if (in_array($h, $m[$bases[$b]])) {
        continue;
      } else {
        $forall = false;
        break;
      }
    }
    
    if ($forall) break;
    $p++;
    
    if ($p == count($m[$base])) {
      print "not enough heuristics";
      die();
    }
    
  } while (true); 
  
  $answer = $h;
  
  fwrite($output, sprintf("Case #%d: %d\r\n", $X, $answer));
}

fclose($input);
fclose($output);