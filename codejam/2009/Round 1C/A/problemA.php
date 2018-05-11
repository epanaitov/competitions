<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$input = fopen("input", "r");
$output = fopen("output", "w");

$N = intval(fgets($input));


function my_convert($number, $base) {
  $result = 0.0;
  
  for ($i=0; $i<count($number); $i++) {
    $result+= $number[$i]*pow($base, count($number)-$i-1);
  }
  
  return $result;
}

for ($X=1; $X <= $N; $X++) {
  
  $symbols = trim(fgets($input));
  
  $digits = array();
  
  $first = $symbols{0}; 
  
  $digits[$first] = 1;
  
  $number = array();
  $number[0] = 1;
  
  
  
  for ($i=1; $i<strlen($symbols); $i++) {
    
    $sym = $symbols{$i};
    
    if ($sym == $first) {
      $number[$i] = 1;
    } else {
      $digits[$sym] = 0;
      $number[$i] = 0;
      break;
    }
  }
  
  if (count($number) < strlen($symbols)) {
    
    $last = 1;
    
    for ($j = $i+1; $j<strlen($symbols); $j++) {
      $sym = $symbols{$j};
      if (array_key_exists($sym, $digits)) {
        $number[$j] = $digits[$sym];
      } else {
        $last++;
        $digits[$sym] = $last;
        $number[$j] = $digits[$sym];
      }
    }
    
  }
  
  $max = 0;
  for ($i=0; $i<count($number); $i++) {
    if ($number[$i] > $max) $max = $number[$i];
  }
  
  $base = $max+1;
  
  if ($X == 23) {
    var_dump($number);
    
  }
  
  $answer = my_convert($number, $base);
  //$answer = base_convert(join("", $number), $base, 10);
  
  fwrite($output, sprintf("Case #%d: %d\r\n", $X, $answer));
  
}

fclose($input);
fclose($output);