<?php

/**
 * Use PHP 5.2.6 to run $this
 */

$input = fopen("input", "r");
$output = fopen("output", "w");

$N = intval(fgets($input));

function read_recursive() {
  global $input;
  
  do {
  
    $line = fgets($input);
    $line = trim(str_replace(array("(", ")"), "", $line));
  
  } while (empty($line));
  
  $line = split(" ", $line);

  $return = array();
  
  $return['weight'] = array_shift($line);

  if (!empty($line)) {
    // there is a tree
    $return['feature'] = array_shift($line);
    $return['yes'] = read_recursive();
    $return['no'] = read_recursive();
  }
  
  return $return;
}

function parse_tree($tree, $probab, $features, $index) {
  
  $probab*= $tree['weight'];
  
  if (empty($tree['feature'])) return $probab;
  
  $feature = $tree['feature'];
  
  // search in the features
  /*
  for ($i=$index; $i<count($features); $i++) {
    if ($features[$i] == $feature) {
      // this means yes
      return parse_tree($tree['yes'], $probab, $features, $i);
    }
  }
  */
  
  if (in_array($feature, $features)) {
    // yes
    return parse_tree($tree['yes'], $probab, $features, $i);
  }
  
  return parse_tree($tree['no'], $probab, $features, $index);
}

for ($X=1; $X <= $N; $X++) {
  
  fwrite($output, sprintf("Case #%d:\r\n", $X, $answer));
  
  $line = fgets($input);
  $treeLen = intval($line);
  
  $level = 0;
  $tree = array();
  $tree = read_recursive();
  
  do {
    $line = fgets($input);
    $line = trim(str_replace(array("(",")"), "", $line));
  } while (empty($line));
  
  $A = intval($line);
  
  for ($a=0; $a<$A; $a++) {
    $line = trim(fgets($input));
    $line = split(" ", $line);
    $name = array_shift($line);
    
    $features = intval(array_shift($line));
    
    $p = parse_tree($tree, 1.0, $line, 0);
    
    fprintf($output, "%0.7f\r\n", $p);
  }
}

fclose($input);
fclose($output);