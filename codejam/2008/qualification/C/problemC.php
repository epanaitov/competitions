<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$input = fopen("input", "r");
$output = fopen("output", "w");

function radius($x, $y) {
  return $x*$x + $y*$y;
}

function integral($x1, $x2, $R) {
  $val2 = ($x2*sqrt($R*$R - $x2*$x2) + $R*$R*asin($x2/$R))/2;
  
  $val1 = ($x1*sqrt($R*$R - $x1*$x1) + $R*$R*asin($x1/$R))/2;
  
  return $val2 - $val1;
}


$N = intval(fgets($input));

for ($k=1; $k <= $N; $k++) {
  
  list($f, $R, $t, $r, $g) = fscanf($input, "%f %f %f %f %f");
  
  if ($g < 2*$f) {
    fwrite($output, sprintf("Case #%d: %0.6f\r\n", $k, 1.0));
    continue;
  }
  
  $Rt = $R - $t - $f;
  
  $i = $j = 0;
  
  $holes = 0.0;
  
  while (true) {
    
    $i = 0;
    
    while (true) {
      $x1 = $x2 = $y1 = $y = 0.0;
      
      $x1 = $r + $i*($g + 2*$r)+$f;
      $x2 = $x1 + $g - 2*$f;
      
      $y1 = $r + $j*($g + 2*$r) + $f;
      $y2 = $y1 + $g - 2*$f;
      
      if (radius($x1, $y1) > $Rt*$Rt) break;
      
      if (radius($x2, $y2) > $Rt*$Rt) {
        
        // here can be four variants
        
        // 1. both corners outside the ring
        if ((radius($x1, $y2) > $Rt*$Rt) && (radius($x2, $y1) > $Rt*$Rt)) {
          $ix = sqrt($Rt*$Rt - $y1*$y1);
          
          $holes+= integral($x1, $ix, $Rt) - ($ix - $x1)*$y1;
        }
        
        // 2. and 3. One of the corners inside the ring
        if ((radius($x1, $y2) > $Rt*$Rt) && (radius($x2, $y1) < $Rt*$Rt)) {
          $holes+= integral($x1, $x2, $Rt) - ($x2-$x1)*$y1; 
        }
        
        if ((radius($x1, $y2) < $Rt*$Rt) && (radius($x2, $y1) > $Rt*$Rt)) {
          $ix1 = sqrt($Rt*$Rt - $y2*$y2);
          $ix2 = sqrt($Rt*$Rt - $y1*$y1);

          // for now let it be triangle
          $holes+= integral($ix1, $ix2, $Rt) - ($ix2 - $ix1)*$y1 + ($y2-$y1)*($ix1-$x1);  
        }
        
        // 4. both corners inside the ring
        if ((radius($x1, $y2) < $Rt*$Rt) && (radius($x2, $y1) < $Rt*$Rt)) {
          $ix = sqrt($Rt*$Rt - $y2*$y2);
          
          $holes+= integral($ix, $x2, $Rt) - ($x2-$ix)*$y1 + ($ix - $x1)*($y2-$y1); 
        }
        
      } else {
        $holes+= ($x2-$x1)*($y2-$y1); 
      }
      
      // bla bla
      $i++;
    }
    $j++;
    if ($r + $j*($g + 2*$r) > $Rt) break;
  }
  
  //$total = $entire - $holes + $ring; 
  
  $answer = 1.0 - $holes/(M_PI*$R*$R/4);
  
  printf("%f: %0.6f", $holes, $answer);
  print "<br />";
  
  fwrite($output, sprintf("Case #%d: %0.6f\r\n", $k, $answer));
}

fclose($input);
fclose($output);