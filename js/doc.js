
document.addEventListener('DOMContentLoaded', function() {
    // Array de rutas de imágenes
    const images = [
        'img/dentist.jpg',
        'img/auto_repair.jpg',
        'path/to/your/image3.png'
    ];

    // Seleccionar una imagen aleatoria
    const randomImage = images[Math.floor(Math.random() * images.length)];

    // Aplicar la imagen seleccionada al fondo del div
    const searchSection = document.getElementById('search-section');
    searchSection.style.backgroundImage = `url(${randomImage})`;
});
