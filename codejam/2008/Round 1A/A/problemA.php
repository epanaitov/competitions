<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$input = fopen("input", "r");
$output = fopen("output", "w");

$N = intval(fgets($input));

for ($X=1; $X <= $N; $X++) {
  
  $len = intval(fgets($input));
  
  $v1 = array();
  $v2 = array();
  
  $tmp = split(" ", fgets($input));
  for ($i=0; $i<$len; $i++) $v1[$i] = intval(trim($tmp[$i]));
  
  $tmp = split(" ", fgets($input));
  for ($i=0; $i<$len; $i++) $v2[$i] = intval(trim($tmp[$i]));
  
  sort($v1);
  sort($v2);
  $v2 = array_reverse($v2);
  
  $answer = 0;
  for ($i=0; $i<$len; $i++) {
    $answer+= $v1[$i]*$v2[$i];
  }
  
  
  fwrite($output, sprintf("Case #%d: %d\r\n", $X, $answer));
}

fclose($input);
fclose($output);