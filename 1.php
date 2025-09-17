<?php 
// A000124 of Sloane’s OEIS.

function A000124($n) {
  $hasil = [];
  for($i = 1; $i <= $n; $i++) {
    $rumus = 1 + ($i * ($i - 1)) / 2;
    array_push($hasil, $rumus);
  }
  return $hasil;
}

$input1 = 7;
echo "input  : {$input1} \n";
echo "output : ";
echo implode("-", A000124($input1));
echo "\n\n";

$input2 = 5;
echo "input  : {$input2} \n";
echo "output : ";
echo implode("-", A000124($input2));
echo "\n\n";


$input3 = 14;
echo "input  : {$input3} \n";
echo "output : ";
echo implode("-", A000124($input3));
echo "\n\n";
?>
