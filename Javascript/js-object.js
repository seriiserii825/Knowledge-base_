Object.assign({}, newObject); // copy object

	// Поверхностное копирование
	let obj = {name: 'Serii'};
	let ob2 = {date: 20}
	let newObj = Object.assign({}, obj, ob2);

// copy object deeply
JSON.parse(JSON.stringify(person))

const persone = {
	name: 'Alex',
	tel: '+777777',
  parrents: {
  mom: 'Olga',
dad: 'Mike'
}
};

const clone = JSON.parse(JSON.stringify(persone));


	// Object to array
	let ob = {name: 'Serii', color: 'red', active: false, age: 22};
	let keys = Object.keys(ob); //array of object keys
	let values = Object.values(ob);//array of object values
	let entries = Object.entries(ob);//array of keys and values
	let fromEntriesToObject = Object.fromEntries([['some', 'first'], ['new', 'second']]);//Object from array

//empty object
function isEmpty(obj) {
    return Object.keys(obj).length === 0;
}
