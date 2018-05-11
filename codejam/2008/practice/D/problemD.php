<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$input = fopen("input", "r");
$output = fopen("output", "w");
/*
$N = 50;

$sum = 0;
$p = 1;

for ($i=$N; $i>0; $i--) {
  $p = $i*$p;
  $sum+= $p;
}

print $sum;

*/

$start = mktime();

for ($i=0; $i<100000000; $i++) {
  $sum+= 1;
}

$finish = mktime();

print $finish-$start;

fclose($input);
fclose($output);