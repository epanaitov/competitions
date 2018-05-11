<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$input = fopen("input", "r");
$output = fopen("output", "w");

$N = intval(fgets($input));

for ($X=1; $X <= $N; $X++) {
  
  list($P, $Q) = fscanf($input, "%d %d");
  
  $ners = array();
  
  do {
    $line = trim(fgets($input));
  } while (empty($line));
  
  $line = split(" ", $line);
  
  for ($q=0; $q<$Q; $q++) {
    $ners[] = intval(array_shift($line));
  }
  
  $cells = array();
  for ($p=1; $p<= $P; $p++) {
    $cells[$p] = 1; 
  }
  
  $coins = 0;
  
  $rel = array();
  do {
    for ($p=1; $p<= $P; $p++) {
      if ($cells[$p] == 1) {
        $s = $p;
        break;
      }
    }
    $e = $s;
    
    $min = $P;
    for ($p=1; $p<= $P; $p++) {
      if ($cells[$p] == 0) {
        $e = $p;
        
        $middle = ($e+$s)/2;
        
        foreach ($ners as $ner) {
          if (in_array($ner, $rel)) continue;
          if ($min > abs($middle - $ner)) {
            $min = abs($middle - $ner);
            $out = $ner;
          }
        }
        
      }
    }
    
    if ($e == $s) {
      $e = $P;
      
      $middle = ($e+$s)/2;
        
        foreach ($ners as $ner) {
          if (in_array($ner, $rel)) continue;
          if ($min > abs($middle - $ner)) {
            $min = abs($middle - $ner);
            $out = $ner;
          }
        }
      
    }
    
    $cells[$out] = 0;
    $rel[] = $out;
    
    //var_dump($cells);
    
    for ($i=$out-1; $i> 0; $i--) {
      if ($cells[$i] == 1) {
        $coins++;
      } else {
        break;
      }
    }
    
    for ($i=$out+1; $i<= $P; $i++) {
      if ($cells[$i] == 1) {
        $coins++;
      } else {
        break;
      }
    }
  } while (count($rel) < count($ners));
  
  
  fwrite($output, sprintf("Case #%d: %d\r\n", $X, $coins));
}

fclose($input);
fclose($output);