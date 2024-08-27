var applyTextStroke = function (className, color, width) {
  var r = width;
  var n = Math.ceil(2  Math.PI  r); // numărul de umbre
  var str = '';
  for (var i = 0; i < n; i++) { // adaugă umbre în n direcții distribuite uniform
    var theta = (2  Math.PI  i) / n;
    str += (r  Math.cos(theta)) + "px " + (r  Math.sin(theta)) + "px 0 " + color + (i === n - 1 ? '' : ',');
  }
  var arr = document.getElementsByClassName(className);
  for (var j = 0; j < arr.length; j++) {
    arr[j].style.textShadow = str;
  }
};

setTimeout(function() {
  applyTextStroke("stroke-rd", "#4C2419", 8);
	applyTextStroke("stroke-bl", "#34769F", 8);
}, 50); // Delay de 1 secundă (1000 milisecunde)
