function showJsonPhotos(data) {
	let ul = document.createElement('ul');
	data.some((item, i) => {
		ul.innerHTML += `
			<li>
				<img src="${item.url}" alt="">
			</li>
		`;
		return i === 10;
	});
	document.body.append(ul);
}

fetch('https://jsonplaceholder.typicode.com/photos')
	.then(response => response.json())
	.then(json => showJsonPhotos(json));

fetch('https://jsonplaceholder.typicode.com/posts',{
		method: "POST",
		body: JSON.stringify({name: 'Alex'}),
		headers: {
			'Content-type': 'application/json'
		}
	})
	.then((response) => response.json())
	.then(json => console.log(json));

//form
	const form = document.querySelector('form');
	form.addEventListener('submit', (e) => {
		e.preventDefault();
		const formData = new FormData(form);
		fetch('server.php', {
			method: "POST",
			body: formData
		}).then(data => data.text())
			.then((data) => {
				console.log(data);
			}).catch(() => {
			console.log('error');
		}).finally(() => {
			form.reset();
		});
	});

//json
	const form = document.querySelector('form');
	form.addEventListener('submit', (e) => {
		e.preventDefault();
		const formData = new FormData(form);

		const object = {};
		formData.forEach((value, key) => {
			object[key] = value;
		});
		const jsonO = JSON.stringify(object);
		fetch('server.php', {
			method: "POST",
			headers: {
				'Content-type': 'application/json'
			},
			body: jsonO
		}).then(data => data.text())
			.then((data) => {
				console.log(data);
			}).catch(() => {
			console.log('error');
		}).finally(() => {
			form.reset();
		});
	});
