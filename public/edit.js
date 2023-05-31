const delBtn = document.querySelector('.delete');
const pop = document.querySelector('.pop-container');
const no = document.querySelector('.no');


delBtn.addEventListener('click', () => {
   pop.style.display = 'flex';
});

no.addEventListener('click', () => {
    pop.style.display = 'none';
});

window.addEventListener('click', (e) => {
  if(e.target === pop) {
    pop.style.display = 'none';
  }
});


