//============================= Custom functions
	const arr = ['Sanya', 'Denis', 'Olga', 'Tatiana'];
	let value;

	function mapArray(arr, fn) {
		let result = [];
		for (let i = 0; i < arr.length; i++) {
			result.push(fn(arr[i]));
		}
		return result;
	}

	function nameLength(el){
		return el.length;
	}

	function nameUppercase(el){
		return el.toUpperCase();
	}

	value = mapArray(arr, nameLength);
	value = mapArray(arr, nameUppercase);

//=================== return functions
	function greeting(firstName){
		return function (lastname) {
			return `Hello, ${firstName}, ${lastname}`;
		}
	}

	const firstName = greeting('Serii');
	const fullName = firstName('Burduja');


	function question(job){
		const jobDictionary = {
			developer: 'what is Javascript?',
			teacher: 'what subject are you teaching?',
		};

		return function (name) {
			return `${name}, ${jobDictionary[job]}`;
		}
	}
	const questionForAnswer = question('developer');
	console.log(questionForAnswer('Serii'));
