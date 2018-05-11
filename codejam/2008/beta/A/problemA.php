<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$input = fopen("input", "r");
$output = fopen("output", "w");

$N = fgets($input);

function scalarMul($x1, $y1, $x2, $y2, $x3, $y3) {
  
  $a1 = (int) $x2 - $x1;
  $b1 = (int) $y2 - $y1;
  
  $a2 = (int) $x3 - $x1;
  $b2 = (int) $y3 - $y1;
  
  return (int) $a1*$a2 + $b1*$b2;
}

for ($i=1; $i <= $N; $i++) {
  list($x1, $y1, $x2, $y2, $x3, $y3) = fscanf($input, "%d %d %d %d %d %d");
  
  $l1 = ($x2-$x1)*($x2-$x1) + ($y2-$y1)*($y2-$y1);
  $l2 = ($x3-$x1)*($x3-$x1) + ($y3-$y1)*($y3-$y1);
  $l3 = ($x3-$x2)*($x3-$x2) + ($y3-$y2)*($y3-$y2);
  
  if (($l1 == 0) || ($l2 == 0) || ($l3 == 0)) {
    // not a triangle
    fwrite($output, sprintf("Case #%d: not a triangle\r\n", $i));
    continue;
  }
  
  $lengths = "";
  
  if (($l1 != $l2) && ($l1 != $l3) && ($l2 != $l3)) $lengths = "scalene";
  else $lengths = "isosceles"; // or equilateral actually
  
  // scalar mul
  $angles = "";
  
  $mul1 = scalarMul($x1, $y1, $x2, $y2, $x3, $y3);
  $mul2 = scalarMul($x2, $y2, $x1, $y1, $x3, $y3);
  $mul3 = scalarMul($x3, $y3, $x2, $y2, $x1, $y1);
  
  if ($mul1*$mul1 == $l1*$l2) {
    fwrite($output, sprintf("Case #%d: not a triangle\r\n", $i));
    continue;
  }
  
  if ($mul2*$mul2 == $l1*$l3) {
    fwrite($output, sprintf("Case #%d: not a triangle\r\n", $i));
    continue;
  }
  
  if ($mul3*$mul3 == $l2*$l3) {
    fwrite($output, sprintf("Case #%d: not a triangle\r\n", $i));
    continue;
  }
  
  if (($mul1 == 0) || ($mul2 == 0) || ($mul3 == 0)) $angles = "right";
  
  if (empty($angles)) {
    if (($mul1 < 0) || ($mul2 < 0) || ($mul3 < 0)) $angles = "obtuse";
  }
  
  if (empty($angles)) $angles = "acute";
  
  fwrite($output, sprintf("Case #%d: %s %s triangle\r\n", $i, $lengths, $angles));  
}

fclose($input);
fclose($output);