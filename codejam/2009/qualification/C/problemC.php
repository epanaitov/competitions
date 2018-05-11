<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$wtcj = "welcome to code jam";

$input = fopen("input", "r");
$output = fopen("output", "w");

$N = intval(fgets($input)); 

for ($X=1; $X <= $N; $X++) {
  $text = fgets($input);
  /*
  if (!preg_match("/.*(w.*e.*l.*c.*o.*m.*e.*\s.*t.*o.*\s.*c.*o.*d.*e.*\s.*j.*a.*m)./", $text)) {
    fprintf($output, "Case #%d: %04d\r\n", $X, 0);
    continue;
  }
  */
  $m = array();
  for ($i=0; $i<strlen($wtcj); $i++) {
    for ($j=0; $j<strlen($text); $j++) {
      $m[$i][$j] = 0;
    }
  }
  
  $i = 1;
  for ($j=1; $j<=strlen($text); $j++) {
    $l = $wtcj{strlen($wtcj)-1};
      if ($text{strlen($text)-$j} == $l) {
        $m[$i][$j] = $m[$i][$j-1] + 1;
      } else {
        $m[$i][$j] = $m[$i][$j-1];
      }
  }
  
  for ($i=2; $i<=strlen($wtcj); $i++) {
    $l = $wtcj{strlen($wtcj)-$i};
    
    for ($j=1; $j<=strlen($text); $j++) {
      if ($text{strlen($text)-$j} == $l) {
        $sum = $m[$i][$j-1] + $m[$i-1][$j-1];
        if ($sum > 10000) $sum = intval($sum%10000);
        $m[$i][$j] = $sum;
      } else {
        $m[$i][$j] = $m[$i][$j-1];
      }
    }
  }
  
  fprintf($output, "Case #%d: %04d\r\n", $X, $m[strlen($wtcj)][strlen($text)]);
}

fclose($input);
fclose($output);