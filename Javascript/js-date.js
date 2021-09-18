const now = new Date(); // Дату помещаем в переменную now.
const now = new Date('2011-02-22'); // Передаем дату в виде строки
const now = new Date(2011, 2, 22, 14); 
 Цифры состоящие из одного символа не должны содержать 0. 
 2 - месяц превращается в 3, так как месяцы начинаются с 0
 14 - часов превращаются в 11 - (-3) 
const now = new Date(timestamp); // Колличесво миллисекунд
now.getFullYear();
now.getMonth();
now.getDate(); - число
now.getDay(); - номер дня недели, нумерация начинается с воскрсенья 0
now.getHours(); - местное время
now.getUTCHours(); - время по utc
now.getTimezoneOffset(); - Разница по utc в минутах
now.getTime(); - timestamp
now.setDate(4);
new Date.parse('2002-05-01'); // ====  new Date('2011-02-22');

let start new Date();

for (let i = 0; i < 100000; i++){
  let some = i ** 3;
}

let end = new Date();

let difference = end - start;

console(difference); //in milliseconds


================

    formatDate(date) {
      console.log(date, "date");
      let options = {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "numeric",
        minute: "numeric",
        second: "numeric",
        hour12: false
      };

      return new Intl.DateTimeFormat("ro", options).format(new Date(date));
    }

# unique id
new Date().valueOf()
