// Dense Ranking

function arcade(leaderboard, user) {
  console.log("============================= ARCADE =================================");

  leaderboard.sort((a, b) => b - a) // sort dari terbesar - terkecil
  console.log("Total Permainan Sebelumnya :", leaderboard.length);
  console.log("Semua Skor Sebelumnya :", JSON.stringify(leaderboard));

  console.log("Leaderboard :");
  let denseLeaderboard = [...new Set(leaderboard)]  // hilangkan duplicate score leaderboard
  let ranksLeaderboard = {}
  denseLeaderboard.forEach((score, index) => {
    let rank = index + 1;
    ranksLeaderboard[rank] = score;
  });
  console.table(ranksLeaderboard);

  console.log("----------------------------------------------------------------------");

  console.log("Total Permainanmu :", user.length);
  console.log("Skormu :", JSON.stringify(user));
  user.sort((a, b) => b - a)

  let allScore = [...leaderboard, ...user]                        // menyatukan skor sebelumnya (leaderboard) dan skor baru (GITS)
  console.log("Semua Skor Terbaru :", JSON.stringify(allScore));
  allScore.sort((a, b) => b - a)                                  // sort dari terbesar - terkecil

  let denseAllScore = [...new Set(allScore)]
  let denseRanksAllScore = {}                                     // data leaderboard terbaru, didense (yang duplicate hilang)

  let scoreToRank = {}
  denseAllScore.forEach((score, index) => {
    let rank = index + 1;
    scoreToRank[score] = rank;
    denseRanksAllScore[rank] = score;
  });

  let userRanks = user.map(score => scoreToRank[score])

  console.log("Leaderboard Terbaru :");
  console.table(denseRanksAllScore);
  console.log("SKORMU :", JSON.stringify(user));
  console.log("RANGKS :", JSON.stringify(userRanks)); // ranks dari setiap skormu
  console.log("VISUAL TABEL SKOR & RANKSMU :");
  user.forEach((score, i) => {
    console.log(`Skor: ${score} \t| Rank: ${userRanks[i]}`);
  });
  console.log();
}

// input
let leaderboard1 = [100, 100, 50, 40, 40, 20, 10]; // skor sebelumnya (leaderboard)
let user1 = [5, 25, 50, 120];                      // skor baru (GITS)

let leaderboard2 = [60, 55, 70, 23, 30];
let user2 = [78, 95, 25];

let leaderboard3 = [134, 23, 40, 80, 120, 95, 5, 70, 44, 45, 90, 100]
let user3 = [67, 95, 80, 20, 6, 10, 100, 103]

arcade(leaderboard1, user1)
arcade(leaderboard2, user2)
arcade(leaderboard3, user3)
