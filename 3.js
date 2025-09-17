// Highest Palindrome

function highestPalindrome(s, k) {
  const arr = s.split("");
  const n = arr.length;

  // Step 1: buat palindrom minimal (ubah seminimal mungkin)
  function makePalindrome(left, right, k, changes) {
    if (left >= right) return { arr, k, changes };

    if (arr[left] !== arr[right]) {
      if (k <= 0) return null;
      const bigger = arr[left] > arr[right] ? arr[left] : arr[right];
      arr[left] = arr[right] = bigger;
      changes[`${left}`] = true; // tandai index berubah
      return makePalindrome(left + 1, right - 1, k - 1, changes);
    }
    return makePalindrome(left + 1, right - 1, k, changes);
  }

  // Step 2: maksimalkan ke "9"
  function maximize(left, right, k, changes) {
    if (left > right) return arr.join("");

    if (left === right) {
      if (k > 0) arr[left] = "9";
      return arr.join("");
    }

    if (arr[left] !== "9") {
      if (changes[`${left}`] && k > 0) {
        arr[left] = arr[right] = "9"; // Sudah pernah diubah = butuh 1 langkah untuk jadi 9
        return maximize(left + 1, right - 1, k - 1, changes);
      } else if (!changes[`${left}`] && k > 1) {
        arr[left] = arr[right] = "9"; // Belum pernah diubah = butuh 2 langkah untuk jadi 9
        return maximize(left + 1, right - 1, k - 2, changes);
      }
    }

    return maximize(left + 1, right - 1, k, changes);
  }

  // Proses rekursif
  const firstPass = makePalindrome(0, n - 1, k, {});
  if (!firstPass) return "-1";
  return maximize(0, n - 1, firstPass.k, firstPass.changes);
}

// ==== TEST CASES ====
const input1 = "3943";
const k1 = 1;
console.log(`input : ${input1} \t| k : ${k1} \t| output :`, highestPalindrome(input1, k1));

const input2 = "932239";
const k2 = 2;
console.log(`input : ${input2} \t| k : ${k2} \t| output :`, highestPalindrome(input2, k2));

const input3 = "12345";
const k3 = 1;
console.log(`input : ${input3} \t| k : ${k3} \t| output :`, highestPalindrome(input3, k3));  

console.log();
