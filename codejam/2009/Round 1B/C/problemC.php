<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$input = fopen("input", "r");
$output = fopen("output", "w");

$N = intval(fgets($input));

$base = sqrt(5) + 3;

$baseDot = 43;

$mul = array();
for ($i=0; $i<$baseDot+1; $i++) {
  $mul[$baseDot-$i] = intval($base%10);
  $base = ($base - $mul[$i])*10; 
}

for ($X=1; $X <= $N; $X++) {
  
  $dot = 0;
  
  $n = intval(fgets($input));
  
  $long = array(1);
  
  for ($d=0; $d<$n; $d++) {
    
    $res = array();
    
    $rem = 0;
    for ($i=0; $i<$baseDot+1; $i++) {
      for ($j=0; $j<count($long); $j++) {
        
        $tmp1 = $mul[$i]*$long[$j];
        $tmp1+= $rem;
        if (!empty($res[$i+$j])) {
          $tmp1+= $res[$i+$j];
        }
        $res[$i+$j] = $tmp1%10;
        $rem = floor($tmp1/10);
      }
      if ($rem > 0) $res[] = $rem;
    }
    
    $long = $res;
    $dot+=$baseDot;
  }
  
  $answer = 0;
  for ($j=$dot; $j<$dot+3; $j++) {
    $answer+= $long[$j]*pow(10, $j-$dot);
  }
  
  fwrite($output, sprintf("Case #%d: %03d\r\n", $X, $answer));
}

fclose($input);
fclose($output);