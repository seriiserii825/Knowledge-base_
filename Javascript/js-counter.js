export default function countUp() {
  const phoneIncoming = document.querySelector('.phone-incoming span');
  const phoneOutgoing = document.querySelector('.phone-outgoing span');
  
  function countNumber(elem, result, interval) {
    let count = 1;
    const increment = () => {
      elem.innerHTML = count;
      if (count > result) {
        clearInterval(counter);
      }
      count++
    }
    const counter = setInterval(increment, interval);
  }
  
  countNumber(phoneIncoming, 99, 100);
  countNumber(phoneOutgoing, 499, 18);
}
