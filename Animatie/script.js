const button = document.getElementById('button');
const button2 = document.getElementById('button2');
let vlak = document.querySelector('.vakje')
let vlak2 = document.querySelector('.vakje2')
let vlak3 = document.querySelector('.vakje3')

const go = () => {
  vlak.classList.toggle('vakje--animatie');
  vlak2.classList.toggle('vakje2--animatie');
  vlak3.classList.toggle('vakje3--animatie');
}

const go2 = () => {
  vlak.classList.toggle('vakje--animatie-backwards');
  vlak2.classList.toggle('vakje2--animatie-backwards');
  vlak3.classList.toggle('vakje3--animatie-backwards');
}

button.addEventListener('click', go);
button2.addEventListener('click', go2)
