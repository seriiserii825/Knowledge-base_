import {CountUp} from 'countup.js';


export default function counterUp() {
	if(document.querySelector('.numbers')){
		const numbers = document.querySelector('.numbers');
		const numbersOffsetTop = numbers.offsetTop - 800;
		let flag = false;
		if (window.innerWidth > 576) {
			window.addEventListener('scroll', function () {
				if (window.pageYOffset > numbersOffsetTop && flag === false) {
					const counterSelection = document.querySelectorAll('.numbers__item');
					counterSelection.forEach((item, index) => {
						const counterNumberElem = item.querySelector('.numbers__title span');
						const counterNumber = counterNumberElem.textContent + '';
						let countUp = new CountUp(counterNumberElem, counterNumber, {duration: 4});
						countUp.start();
					});
					flag = true;
				}
			});
		}
	}
}
