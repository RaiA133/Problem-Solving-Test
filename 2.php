<?php
// Dense Ranking

function arcade($leaderboard, $user)
{
  echo "============================= ARCADE =================================\n";

  rsort($leaderboard); // sort dari terbesar - terkecil
  echo "Total Permainan Sebelumnya : " . count($leaderboard) . "\n";
  echo "Semua Skor Sebelumnya : " . json_encode($leaderboard) . "\n";

  echo "Leaderboard :\n";
  $denseLeaderboard = array_values(array_unique($leaderboard)); // hilangkan duplicate score leaderboard
  $ranksLeaderboard = [];
  foreach ($denseLeaderboard as $index => $score) {
    $rank = $index + 1;
    $ranksLeaderboard[$rank] = $score;
  }
  printTable($ranksLeaderboard);

  echo "----------------------------------------------------------------------\n";

  echo "Total Permainanmu : " . count($user) . "\n";
  echo "Skormu : " . json_encode($user) . "\n";
  rsort($user);

  $allScore = array_merge($leaderboard, $user);                   // menyatukan skor sebelumnya (leaderboard) dan skor baru (GITS)
  echo "Semua Skor Terbaru : " . json_encode($allScore) . "\n";
  rsort($allScore);                                               // sort dari terbesar - terkecil

  $denseAllScore = array_values(array_unique($allScore));
  $denseRanksAllScore = [];                                       // data leaderboard terbaru, didense (yang duplicate hilang)

  $scoreToRank = [];
  foreach ($denseAllScore as $index => $score) {
    $rank = $index + 1;
    $scoreToRank[$score] = $rank;
    $denseRanksAllScore[$rank] = $score;
  }

  $userRanks = [];
  foreach ($user as $score) {
    $userRanks[] = $scoreToRank[$score];
  }

  echo "Leaderboard Terbaru :\n";
  printTable($denseRanksAllScore);
  echo "SKORMU : " . json_encode($user) . "\n";
  echo "RANGKS : " . json_encode($userRanks) . "\n"; // ranks dari setiap skormu
  foreach ($user as $i => $score) {
    echo "Skor: {$score} \t| Rank: {$userRanks[$i]}\n";
  }
  echo "\n";
}

// Helper PHP: ganti console.table di JS
function printTable($assocArray) 
{
  echo str_pad("Rank", 8) . "Score\n";
  echo str_repeat("-", 20) . "\n";
  foreach ($assocArray as $rank => $score) {
    echo str_pad($rank, 8) . $score . "\n";
  }
  echo "\n";
}

// input
$leaderboard1 = [100, 100, 50, 40, 40, 20, 10]; // skor sebelumnya (leaderboard)
$user1 = [5, 25, 50, 120];                      // skor baru (GITS)

$leaderboard2 = [60, 55, 70, 23, 30];
$user2 = [78, 95, 25];

$leaderboard3 = [134, 23, 40, 80, 120, 95, 5, 70, 44, 45, 90, 100];
$user3 = [67, 95, 80, 20, 6, 10, 100, 103];

arcade($leaderboard1, $user1);
arcade($leaderboard2, $user2);
arcade($leaderboard3, $user3);
