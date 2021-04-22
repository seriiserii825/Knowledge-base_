// get variable value
window.getComputedStyle(document.documentElement).getPropertyValue('--body-color');

//set variable with js and get style
document.body.style.setProperty('--body-color', 'blue')
const bodyColor = document.body.style.getPropertyValue('--body-color');
document.querySelector('.card-body').style.setProperty('--body-color', 'yellow');


	function onThemeSelectHandler(e) {
		const selectedTheme = selectThemeElement.value;
		setTheme(selectedTheme);
	}

	function setTheme(name) {
		const selectedThemeObj = themes[name];
		Object.entries(selectedThemeObj).forEach(([key, value]) => {
			document.documentElement.style.setProperty(key, value);
		});
	}

	selectThemeElement.addEventListener('change', onThemeSelectHandler);
