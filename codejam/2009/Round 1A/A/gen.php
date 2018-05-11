<?php

function happy($num, $base) {
  
  $num = base_convert($num, 10, $base);
  
  $t = 0;
  
  do {
    $tmp = 0;
    
    for ($i=0; $i<strlen($num); $i++) {
      $tmp+= intval($num{$i})*intval($num{$i});
    }
    
    $tmp = base_convert($tmp, 10, $base);
    
    if (intval($tmp) == 1) return true;
    
    $num = $tmp;
    
    $t++;
    
    if ($t > 20) return false;
  
  } while (true);
  
}

$out = fopen("happy", "a");

for ($b = 2; $b<11; $b++) {
  
  fwrite($out, $b);

  for ($i=2; $i<100000; $i++) {
    if (happy($i, $b)) fwrite($out, " ".$i);
  }
  
  fwrite($out, "\r\n");
}

print "done";

fclose($out);