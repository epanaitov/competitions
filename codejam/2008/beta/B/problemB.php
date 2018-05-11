<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$input = fopen("input", "r");
$output = fopen("output", "w");

$N = fgets($input);

for ($j=1; $j <= $N; $j++) {

  $line = fgets($input);
  $products = split(" ", $line);
  
  for ($i=0; $i<count($products); $i++) $products[$i] = trim($products[$i]);
  
  $line = fgets($input);
  $guesses = split(" ", $line);
  
  for ($i=0; $i<count($products); $i++) $guesses[$i] = intval(trim($guesses[$i]));

  $M = array();
  for ($i=0; $i<count($products); $i++) {
    $M[$i]['prev'] = 0;
    $M[$i]['len'] = 0;
    $M[$i]['tail'] = "";
  }
  
  for ($i=1; $i<count($products); $i++) {
    for ($k=$i-1; $k>=0; $k--) {
      if (($guesses[$k] < $guesses[$i]) && ($M[$i]['len'] <= $M[$k]['len']+1)) {
        
        // restore asc
        
        $asc = array();
        $asc[] = $i;
        $p = $k;
        while ($M[$p]['len'] > 0) {
          $asc[] = $p;
          $p = $M[$p]['prev'];
        }
        $asc[] = $p;
        
        $diff = array();
      
        for ($x = 0; $x<count($products); $x++) {
          if (!in_array($x, $asc)) $diff[] = $products[$x];
        }
        sort($diff);
        
        if ($i == 6) {
          print $k;
          var_dump($diff); 
        }
        
        if (($M[$k]['len']+1 > $M[$i]['len']) || (join(" ", $diff) < $M[$i]['tail']) || empty($M[$i]['tail'])) {
        
          $M[$i]['prev'] = $k;
          $M[$i]['len'] = $M[$k]['len']+1;
          $M[$i]['tail'] = join(" ", $diff);
        }
        
      }
    }
  }
  
  for ($i=0; $i<count($products); $i++) {
    if ($M[$i]['len'] == 0) {
      $tmp = $products;
      unset($tmp[$i]);
      sort($tmp);
      $M[$i]['tail'] = join(" ", $tmp); 
    }
  }
  
  var_dump($M);
  
  // now the matrix knows maximum length of ascending subseq
  
  $max = 0;
  for ($i=1; $i<count($products); $i++) {
    if ($max < $M[$i]['len']) $max = $M[$i]['len']; 
  }
  
  $answer = null;
  
  for ($i=0; $i<count($products); $i++) {
    if ($max == $M[$i]['len']) {
      // this is one of the longest
      // restore the seq

      if (empty($answer) || ($M[$i]['tail'] < $answer)) $answer = $M[$i]['tail']; 
    }
  }  
  
  fwrite($output, sprintf("Case #%d: %s\r\n", $j, $answer));

}

fclose($input);
fclose($output);