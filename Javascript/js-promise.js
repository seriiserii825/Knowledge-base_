const req = () => {
	return new Promise((resolve, reject) => {
		setTimeout(() => {
			console.log('Ready data');
			const product = {
				name: 'Tv',
				price: 2000
			};
			resolve(product);
		}, 1000);
	});
};

req().then((product) => {
	return  new Promise((resolve, reject) => {
		setTimeout(() => {
			product.status = 'order';
			console.log(product);
			resolve(product);
			// reject();
		}, 1000);
	});
}).then((data) => {
	data.modify = true;
	setTimeout(() => {
		console.log(data);
	}, 1000);
	return data;
}).then(data => {
	setTimeout(() => {
		console.log('finish');
	}, 1000);
}).finally(() => {
	console.log('Finaly');
});
// Finally - будет использоваться в любом случае. Например, отправили форму, и если даже и случилась ошибка, нам все равно нужно ее очистить.
// 	.catch(() => {
// 	console.log('Error');
// });

/**
 * Иногда можно использовать только resolve.
 */
const test = time => {
	return new Promise(resolve => {
		setTimeout(() => resolve(), time);
	});
};

// test(2000).then(() => console.log('2000 ms'));
// test(4000).then(() => console.log('4000 ms'));

/**
 * Используется, чтобы выполнить задачу, после того как отработают все промисы
 */
Promise.all([test(1000), test(2000)]).then(() => {
	console.log('All');
});
/**
 * Используется для выполнения задачи, когда хотя-бы один промис выполнился удачно.
 */
Promise.race([test(1000), test(2000)]).then(() => {
	console.log('All');
});
