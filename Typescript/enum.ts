// числовой или строковый enum
enum Direction {
  Up = 1, // по-умолчанию 1, для строковых enum значения обязательны
  Down,
  Left,
  Right
}

enum Speed {
  low = '60km/h',
  high = '220km/h'
}

// гетерогенный еnum
enum Decision {
  Yes = 1,
  No = 'false'
}

// рассчетный еnum может быть только числовым
function calcEnum(){
  return 2;
}
enum CalculatedEnum {
  Yes = 1,
  No = calcEnum()
}

// enum в runtime можно использовать как объект
function carMove(obj: {low: string, high: string}) {}
carMove(Speed)

// обратный маппинг, получить строковое значения какого-то из enum
enum Test {
  A
}
let test = Test.A;
let nameA = Test[test];

// enum const
// если enum не будет изменятся, что лучше использовать как константу, меньше рессурсов употребляет
const enum ConstEnum{
  A,
  B
}

let d = ConstEnum.A;

// Never
enum Dice {
  One = 1,
  Two
}

function runDice(dice: Dice){
  switch (dice) {
    case Dice.One:
      return 'один';
      break;
    case Dice.Two:
      return 'один';
      break;

    //если в Dice добавится еще один элемент, то a:never будет равен ему и выскочит сообщение об ошибке.
    default:
      const a:never = dice;
  }
}
