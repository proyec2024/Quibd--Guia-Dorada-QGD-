// Arreglo de imágenes
const imagenes = [
    'C:\xampp\htdocs\QGD\img\dentist.jpg',
    'img\dentist.jpg',
    '../img/vet.jpg'
];

// Función para obtener un índice aleatorio
function obtenerIndiceAleatorio(max) {
    return Math.floor(Math.random() * max);
}

// Función para cambiar la imagen
function cambiarImagen() {
    const indice = obtenerIndiceAleatorio(imagenes.length);
    const imagen = document.getElementById('imagen-cambiar');
    imagen.src = imagenes[indice];
    imagen.alt = `Imagen ${indice + 1}`; // Cambiar el texto alternativo si es necesario
}

// Cambiar la imagen al cargar la página
window.onload = cambiarImagen;
