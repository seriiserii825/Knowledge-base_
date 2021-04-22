//to json
JSON.stringify(person);
// from json
JSON.parse(person)

json - javascript object notation

В качестве значений можно использовать и null.

const persone = {
  name: 'Alex',
  tel: '+777777'
};

const toServer = JSON.stringify(persone);
const fromServer = JSON.parse(toServer);

json-server
fetch('http://localhost:5050/menu')
        .then(data => data.json())
        .then(data => {
        console.log(data);
});
