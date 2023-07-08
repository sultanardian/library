require('./bootstrap');

const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})

const name = 'id';

const localization = {
  today: 'Перейти сегодня',
  //...
  locale: 'id',
  startOfTheWeek: 1
};

export { localization, name };