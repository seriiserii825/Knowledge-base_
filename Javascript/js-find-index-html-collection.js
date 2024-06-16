function getElementIndex(el) {
  return [...el.parentElement.children].indexOf(el);
}
// Call it like this:

const index = getElementIndex(element);

