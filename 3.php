<?php
// Highest Palindrome

function makePalindrome(&$arr, $left, $right, $k, &$changes) // Step 1: buat palindrom minimal (ubah seminimal mungkin)
{
  if ($left >= $right) return ["arr" => $arr, "k" => $k, "changes" => $changes];

  if ($arr[$left] !== $arr[$right]) {
    if ($k <= 0) return null;
    $bigger = ($arr[$left] > $arr[$right]) ? $arr[$left] : $arr[$right];
    $arr[$left] = $bigger;
    $arr[$right] = $bigger;
    $changes[$left] = true;
    return makePalindrome($arr, $left + 1, $right - 1, $k - 1, $changes);
  }
  return makePalindrome($arr, $left + 1, $right - 1, $k, $changes);
}

function maximize(&$arr, $left, $right, $k, &$changes) // Step 2: maksimalkan ke "9"
{
  if ($left > $right) return implode("", $arr);

  if ($left === $right) {
    if ($k > 0) $arr[$left] = "9";
    return implode("", $arr);
  }

  if ($arr[$left] !== "9") {
    if (isset($changes[$left]) && $k > 0) {
      $arr[$left] = "9";
      $arr[$right] = "9";
      return maximize($arr, $left + 1, $right - 1, $k - 1, $changes);
    } elseif (!isset($changes[$left]) && $k > 1) {
      $arr[$left] = "9";
      $arr[$right] = "9";
      return maximize($arr, $left + 1, $right - 1, $k - 2, $changes);
    }
  }

  return maximize($arr, $left + 1, $right - 1, $k, $changes);
}

function highestPalindrome($s, $k)
{
  $arr = str_split($s);
  $changes = [];
  $firstPass = makePalindrome($arr, 0, count($arr) - 1, $k, $changes);

  if ($firstPass === null) return "-1";

  return maximize($arr, 0, count($arr) - 1, $firstPass["k"], $firstPass["changes"]);
}

// ==== TEST CASES ====
$input1 = "3943";
$k1 = 1;
echo "input : {$input1} \t| k : {$k1} \t| output : " . highestPalindrome($input1, $k1) . "\n";

$input2 = "932239";
$k2 = 2;
echo "input : {$input2} \t| k : {$k2} \t| output : " . highestPalindrome($input2, $k2) . "\n";

$input3 = "12345";
$k3 = 1;
echo "input : {$input3} \t| k : {$k3} \t| output : " . highestPalindrome($input3, $k3) . "\n";

echo "\n";
