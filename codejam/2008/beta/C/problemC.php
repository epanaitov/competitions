<?php

/**
 * Use PHP 5.2.6 to run $this
 */

define("INFIN", 100000000);

$input = fopen("input", "r");
$output = fopen("output", "w");

$N = intval(fgets($input));



for ($x=1; $x <= $N; $x++) {
  
  $cities = array();
  
  list($num_roads, $cities[0]) = fscanf($input, "%d %s");
  
  $roads = array();
  for ($r = 0; $r<$num_roads; $r++) {
    list($from, $to, $time) = fscanf($input, "%s %s %d");
    $roads[$r]['from'] = $from;
    $roads[$r]['to'] = $to;
    $roads[$r]['time'] = $time;
    if (!in_array($from, $cities))  $cities[] = $from;
    if (!in_array($to, $cities)) $cities[] = $to;
  }
  
  $visited = array();
  $M = array();
  
  for ($c=0; $c<count($cities); $c++) {
    $M[$c]['dist'] = INFIN;
    $M[$c]['roads'] = array();
    $M[$c]['name'] = $cities[$c];
  }
  $M[0]['dist'] = 0;
  
  // no queue!
  
  while (count($visited) < count($cities)) {
    
    $min = INFIN;
    $start = -1;
    
    for ($c=0; $c<count($cities); $c++) {
      if (!in_array($c, $visited)) {
        if ($M[$c]['dist'] < $min) {
          $min = $M[$c]['dist'];
          $start = $c;
        }
      }
    }
    
    if ($start == -1) break; // nowhere to to
    
    // put all vertexes where can go
    $city = $cities[$start];
    
    for ($r=0; $r<$num_roads; $r++) {
      if ($roads[$r]['from'] == $city) {
        $to = $roads[$r]['to'];
        //if (!in_array($to, $visited)) {
        if (true) {
          
          $finish = array_search($to, $cities);
          
          if ($M[$finish]['dist'] > $M[$start]['dist'] + $roads[$r]['time']) {
            $M[$finish]['dist'] = $M[$start]['dist'] + $roads[$r]['time'];
            $M[$finish]['roads'] = array();
            if (empty($M[$start]['roads'])) {
              $M[$finish]['roads'][] = array($r);
            } else {
              foreach ($M[$start]['roads'] as $rd) {
                $rd[] = $r;
                if (!in_array($rd, $M[$finish]['roads']))
                  $M[$finish]['roads'][] = $rd;
              }
            }
          } elseif ($M[$finish]['dist'] == $M[$start]['dist'] + $roads[$r]['time']) {
            if (empty($M[$start]['roads'])) {
              $M[$finish]['roads'][] = array($r);
            } else {
              foreach ($M[$start]['roads'] as $rd) {
                $rd[] = $r;
                if (!in_array($rd, $M[$finish]['roads']))
                  $M[$finish]['roads'][] = $rd;
              }
            }
          }
        }
      }
    }
    
    if (!in_array($start, $visited)) $visited[] = $start;
    
  }
  
  var_dump($M);
  
  //die();
  
  $probab = array();
  for ($r=0; $r<count($roads); $r++) $probab[$r] = 0.0;
  
  $city_count = 0;
  for ($c=1; $c<count($cities); $c++) {
    if ($M[$c]['dist'] < INFIN) $city_count++;
  }
  
  //print $city_count;
  
  for ($r=0; $r<count($roads); $r++) {
    for ($c=1; $c<count($cities); $c++) {
      for ($rd=0; $rd<count($M[$c]['roads']); $rd++) {
        if (in_array($r, $M[$c]['roads'][$rd])) {
          // going to add to probab
          $probab[$r]+= (1/count($M[$c]['roads']))*(1/$city_count);
        }
      }
    }
  }
  
  //var_dump($probab);
  
  fwrite($output, sprintf("Case #%d:", $x));
  for ($r=0; $r<count($roads); $r++) {
    fwrite($output, sprintf(" %0.7f", $probab[$r]));
  }
  fwrite($output, "\r\n");
}

fclose($input);
fclose($output);