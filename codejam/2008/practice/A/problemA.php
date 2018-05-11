<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$input = fopen("input", "r");
$output = fopen("output", "w");

$N = fgets($input);

function alien_convert($number, $source, $target) {
  $source_base = strlen($source);

  $decimal = 0;
  
  for ($i=0; $i<strlen($number); $i++) {
    $item = $number{$i};
    $value = strpos($source, $item);
    $decimal+= $value*pow($source_base, strlen($number)-$i-1);
  }
  
  print $decimal." ";
  
  $answer_decimal = array(); 
  
  $target_base = strlen($target);
  
  $rem = 1;
  $cnt = 0;
  
  while ($rem*$target_base <= $decimal) {
    $rem*= $target_base;
    $cnt++;
  }
  
  for ($i = $cnt; $i>= 0; $i--) {
    $item = intval(floor($decimal/pow($target_base, $i)));
    $answer_decimal[] = $item;
    $decimal-= $item*pow($target_base, $i);
  }
  
  $answer = "";
  for ($i=0; $i<count($answer_decimal); $i++) {
    $answer.= $target{$answer_decimal[$i]};
  }
  
  print "<br />";
  
  return  $answer;
}

for ($i=1; $i <= $N; $i++) {
  list($an, $sl, $tl) = fscanf($input, "%s %s %s");
  $answer = alien_convert($an, $sl, $tl);
  fwrite($output, sprintf("Case #%d: %s\r\n", $i, $answer));  
}

fclose($input);
fclose($output);