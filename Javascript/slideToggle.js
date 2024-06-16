https://github.com/ericbutler555/plain-js-slidetoggle?tab=readme-ov-file

element.slideToggle(duration, callback); // opens and closes an element
element.slideUp(duration, callback); // closes/collapses an element
element.slideDown(duration, callback); // opens/expands an element

 // when you click the button, open and close the div:
  document.querySelector('.myBtn').addEventListener('click', () => {
    document.querySelector('.myDiv').slideToggle();
  });
