	function getPrice() {
		console.log(this.price);
	}

	const prod1 = {
		name: 'intel',
		price: 100,
		getPrice,
		info: {
			information: ['2.3ghz'],
			getInfo: function () {
				console.log(this);
			}
		}
	}
	prod1.getPrice(); // 100
	prod1.info.getInfo(); // info

//=====================
	function getPrice() {
		console.log(this.price);
		return this;
	}

	function getName() {
		console.log(this.name);
		return this;
	}

	const prod = {
		name: 'Serii',
		price: 100,
		getPrice,
		getName
	};
	prod.getPrice().getName();

//============================
	function getPrice() {
		console.log(this.price);
		return this;
	}
	const prod = {
		name: 'Serii',
		price: 100,
		getPrice,
		// getName
	};
	const getPriceBind = prod.getPrice.bind(prod);
	setTimeout(getPriceBind, 2000);
