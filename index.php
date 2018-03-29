<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

ini_set('memory_limit', '-1');
//echo ini_get('memory_limit');
while (@ob_end_flush());

$words = array();
$phrase = "wild inovation suly";
$md5 = "87bb2bda651995d346c05b5049b4d78b";

$handle = fopen("dict.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        array_push($words, trim(preg_replace('/\s\s+/', ' ', $line)));
    }

    fclose($handle);
} else {
    // error opening the file.
} 

require_once 'Math/Combinatorics.php';
//$words = array('buy', 'new', 'microsoft');

$phrase_array = array();

array_push($phrase_array, "wild");
array_push($phrase_array, "inovation");
array_push($phrase_array, "suly");

ob_start();
$combinatorics1 = new Math_Combinatorics;
foreach($combinatorics1->combinations($words, 2) as $c) {
    
    $temp = array_merge($phrase_array, $c);
    
    $combinatorics = new Math_Combinatorics;
    foreach($combinatorics->permutations($temp, 5) as $p) {
      $new_phrase =  join(' ', $p);
      //echo "New phrase: " . $new_phrase . PHP_EOL;
      
      if(md5($new_phrase) == $md5){
          die($new_phrase);
      }
    }
}

ob_end_flush(); 
echo "Not match..";
