<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$input = fopen("input", "r");
$output = fopen("output", "w");

$likes = array();

$C = intval(fgets($input));

for ($X=1; $X <= $C; $X++) {

  $N = intval(fgets($input));

  $M = intval(fgets($input));
  
  for ($c = 0; $c < $M; $c++) {
    for ($s=0; $s<$N; $s++) {
      $likes[$c][$s] = -1;
    }
  }
  
  for ($c = 0; $c < $M; $c++) {
    $tmp = split(" ", fgets($input));
    
    $T = intval(array_shift($tmp));
    
    for ($p=0; $p<$T; $p++) {
      
      $shake = intval(array_shift($tmp))-1;
      $malted = intval(array_shift($tmp));
      
      $likes[$c][$shake] = $malted;
    }
    
  }
  
  $matrix = array();
  
  for ($s=0; $s<$N; $s++) {
    $matrix[$s][0] = array();
    $matrix[$s][1] = array();
  }
  
  for ($c = 0; $c < $M; $c++) {
    for ($s=0; $s<$N; $s++) {
      
      $malted = $likes[$c][$s]; 
      
      if ($malted >= 0) {
        // there is a preference
        
        $matrix[$s][$malted][] = $c;
        
      }
    }
  }
  
  var_dump($matrix); die();
  
  fwrite($output, sprintf("Case #%d: %03d\r\n", $X, $answer));
}

fclose($input);
fclose($output);