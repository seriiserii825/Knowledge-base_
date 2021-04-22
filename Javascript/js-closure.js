// Замыкание - функция, которая ссылается на свободные переменные.
// Свободные переменные - переменные, которые не были переданые функции как параметры и не были объявлены локально. 
// Фукнция определенная в замыкании, запоминает окружение в котором она была создана и имеет к ним доступ. Также она имеет доступ к окружению выше и имеет доступ к переменным из родительской функции.
//
	function checkCred(){
		const login = 'test';
		const pass = 'somdkksjdfkj';

		return {
			checkLogin(value){
				return value === login;
			},
			checkPass(value) {
				return value === pass;
			}
		}
	}

	const check = checkCred();
	console.log(check.checkPass('somdkksjdfkj'));
