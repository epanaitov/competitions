<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$input = fopen("input", "r");
$output = fopen("output", "w");

$C = intval(fgets($input));


for ($X=1; $X <= $C; $X++) {

  $flies = intval(fgets($input));
  
  $ax = $ay = $az = 0.0;
  $bx = $by = $bz = 0.0;
  
  for ($f=0; $f<$flies; $f++) {
    $line = trim(fgets($input));
    
    list($x0, $y0, $z0, $vx, $vy, $vz) = split(" ", $line);
    
    $ax+= $x0;
    $ay+= $y0;
    $az+= $z0;
    
    $bx+= $vx;
    $by+= $vy;
    $bz+= $vz;
  }
  
  $ax = $ax/$flies;
  $bx = $bx/$flies;
  $ay = $ay/$flies;
  $by = $by/$flies;
  $az = $az/$flies;
  $bz = $bz/$flies;
  
  $center = $bx*$bx + $by*$by + $bz*$bz;
  
  if (abs($center) < 0.0000000001) {
    $t = 0.0;
    $d = sqrt(pow($ax + $bx*$t, 2) + pow($ay + $by*$t, 2) + pow($az + $bz*$t, 2));
  } else {
    $t = - ($ax*$bx + $ay*$by + $az*$bz)/$center;
    $d = sqrt(pow($ax + $bx*$t, 2) + pow($ay + $by*$t, 2) + pow($az + $bz*$t, 2));
  }
  
  if ($t < 0.0) {
    $t = 0.0;
    $d = sqrt(pow($ax + $bx*$t, 2) + pow($ay + $by*$t, 2) + pow($az + $bz*$t, 2));
  }
  
  fwrite($output, sprintf("Case #%d: %0.8f %0.8f\r\n", $X, $d, $t));
}

fclose($input);
fclose($output);