<?php

$input = fopen("input", "r");
$output = fopen("output", "r");

function color($val, $max) {
  $dec = 15*$val/$max;
  $hex = dechex(floor($dec));
  return "#".$hex.$hex.$hex.$hex.$hex.$hex;
}

$T = intval(fgets($input));
for ($t=1; $t <= $T; $t++) {
  list($H, $W) = fscanf($input, "%d %d");
  
  $alts = array();
  
  for ($h=0; $h<$H; $h++) {
    $line = fgets($input);
    $alts[$h] = split(" ", $line);
  }
  
  $bassins = array();
  
  fgets($output);
  for ($h=0; $h<$H; $h++) {
    $bassins[$h] = split(" ", fgets($output));
  }
  
  print "Case #".$t."<br />";
  for ($h=0; $h<$H; $h++) {
    for ($w=0; $w<$W; $w++) {
      print "<span style=\"color: white; background-color: ".color($alts[$h][$w], 10)."\">".intval($alts[$h][$w])."</span>";
    }
    
    print "&nbsp;&nbsp;&nbsp;&nbsp;";
    
    for ($w=0; $w<$W; $w++) print $bassins[$h][$w];
    
    print "<br />";
  }
  
  
  
}

