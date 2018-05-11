<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$engines = array();

$input = fopen("input", "r");

list($L, $D, $N) = fscanf($input, "%d %d %d");

$dict = array();

for ($i=0; $i < $D; $i++) {
  $dict[] = fgets($input);  
}

$output = fopen("output", "w");

for ($X=1; $X <= $N; $X++) {
  $line = trim(fgets($input));
  // haaa
  
  /*
  $pattern = array();
  $i = -1;
  
  for ($l=0; $l<strlen($line); $l++) {
    switch ($line{$l}) {
      case '(':
      break;
      
      case ')':
      break;
    }
  }
  */
  
  $pattern = "/".str_replace(array("(", ")", " "), array("[", "]", ""), $line)."/";
  
  print $pattern;
  
  $K = 0;
  
  for ($d=0; $d < count($dict); $d++) {
    if (preg_match($pattern, $dict[$d])) $K++;
  }
  
  fwrite($output, sprintf("Case #%d: %d\r\n", $X, $K));  
}

fclose($input);
fclose($output);