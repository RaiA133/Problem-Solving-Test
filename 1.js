// A000124 of Sloane’s OEIS.

function A000124(n) {
  let hasil = [];
  for (i = 1; i <= n; i++) {
    const rumus = 1 + (i * (i - 1)) / 2; // rumus Lazy Carterer / A000124 OEIS (1-2-4-7-11-...-n)
    hasil.push(rumus)
  }
  return hasil
}

let input1 = 7
console.log(`input  : ${input1}`);
console.log("output :", A000124(input1).join("-"), `\n`);

let input2 = 5
console.log(`input  : ${input2}`);
console.log("output :", A000124(input2).join("-"), `\n`);

let input3 = 14
console.log(`input  : ${input3}`);
console.log("output :", A000124(input3).join("-"), `\n`);

