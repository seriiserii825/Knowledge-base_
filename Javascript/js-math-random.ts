type Dice = 1 | 2 | 3 | 4 | 5 | 6;
function rollDice(): Dice {
  let num = Math.floor(Math.random() * 6) + 1;
  return num as Dice;
}
