<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$input = fopen("input", "r");
$output = fopen("output", "w");

$C = intval(fgets($input));

define("MAX_LEN", 25);

function increase($arr) {
  
  $rem = 1;
  
  for ($i=0; $i<count($arr); $i++) {
    $tmp = $arr[$i] + $rem;
    if ($tmp > 9) {
      $rem = intval(floor($tmp/10));
      $tmp = intval($tmp%10);
    } else {
      $rem = 0;
    }
    $arr[$i] = $tmp;
  }
  
  if ($rem > 0) $arr[] = $rem;
  
  return $arr;
}

function satisfies($digg, $digits, $indexes) {
  
  $variant = array();
  
  for ($i=0; $i<count($indexes); $i++) {
    $variant[] = $digg[$i];
  }
  
  $cnt = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
  
  for ($i=0; $i<count($variant); $i++) {
    $cnt[$variant[$i]]++;
  }
  
  for ($i=1; $i<count($digits); $i++) {
    if ($digits[$i] != $cnt[$i]) return false;
  }
  return true;
}

for ($X=1; $X <= $C; $X++) {
  
  $digits = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

  $number = trim(fgets($input));
  for ($i=0; $i<strlen($number); $i++) {
    $d = intval($number{$i});
    if ($d > 0) $digits[$d]++;
  }
  
  $variant = array();
  for ($i=0; $i<=strlen($number); $i++) {
    if ($i<strlen($number)) {
      $variant[$i] = $number{strlen($number)-$i-1};
    } else {
      $variant[$i] = 0;
    }
  }
  
  $digg = $variant;
  sort($digg);
  
  $indexes = array();
  for ($i=strlen($number)-1; $i>=0; $i--) {
    for ($j=0; $j<count($digg); $j++) {
      if ($digg[$j] == $number{$i}) {
        $indexes[] = $j;
        break;
      }
    }
  }
  
  do {
    $indexes = increase($indexes);
  } while (!satisfies($digg, $digits, $indexes));
  
  $variant = array();
  
  for ($i=0; $i<count($indexes); $i++) {
    $variant[] = $digg[$i];
  }
  
  for ($i=MAX_LEN-1; $i>=0; $i--) {
    if ($variant[$i] > 0) {
      break;
    }
  }
  
  $answer = "";
  
  for ($j=$i; $j>= 0; $j--) {
    $answer.= $variant[$j];
  }
  
  fwrite($output, sprintf("Case #%d: %03d\r\n", $X, $answer));
}

fclose($input);
fclose($output);