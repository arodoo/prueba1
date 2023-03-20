const carrusel = document.querySelector('.carrusel');
const imagenes = carrusel.getElementsByTagName('img');

for (let i = 0; i < imagenes.length; i++) {
  imagenes[i].style.left = i * 500 + "px";
}