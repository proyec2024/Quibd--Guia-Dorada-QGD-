<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QGD</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../img/QGD/favicon-16x16.png">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3c73931048.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php session_start(); // Inicia la sesión ?>
    <header>
        <div class="interior">
            <a href="" class="logo"><img src="../img/imagen_QGD-removebg-.png" alt=""></a>
            <nav class="navegacion">
                <ul>
                    <li><a href="https://www.whatsapp.com/"><img class="p-1" src="../img/grafico-de-barras.png" alt="" width="30" height="30">Anúnciate</a></li>
                    <li><a href=""><img class="p-1" src="../img/estrella.png" alt="" width="30" height="30">Escriba una reseña</a></li>
                    <li class="submenu">
                        <a href="">Busca en</a>
                        <ul class="hijos">
                            <li><a href="">Quibdó</a></li>
                            <li><a href="">Medellín</a></li>
                            <li><a href="">Cali</a></li>
                            <li><a href="">Bogotá</a></li>
                        </ul>
                    </li>
                    <?php if (isset($_SESSION['usuario'])): // Verifica si la sesión está iniciada ?>
                        <li><a href="../PHP/logout.php">Cerrar sesión</a></li>
                    <?php else: ?>
                        <li><a href="../html/login.html">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <div class="logo-text">
        Quibdó Guía Dorada<sup>SM</sup>
    </div>
    <div class="search-section" id="search-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="search-container">
                        <input type="text" id="search-input" class="form-control" placeholder="Busca un negocio">
                        <div class="location">
                            <i class="fa fa-map-marker-alt"></i> 
                            Quibdó, Chocó
                        </div>
                        <button class="search-button" onclick="buscarProductos()">BUSCAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container mt-5">
        <div class="row icon-row">
            <div class="col">
                <i class="fas fa-users"></i>
                <p>Encontrar Personas</p>
            </div>
            <div class="col">
                <i class="fas fa-utensils"></i>
                <p> Restaurantes</p>
            </div>
            <div class="col">
                <i class="fas fa-tooth"></i>
                <p>Dentistas</p>
            </div>
            <div class="col">
                <i class="fas fa-wrench"></i>
                <p>Plomero</p>
            </div>
            <div class="col">
                <i class="fas fa-hammer"></i>
                <p>Constructores</p>
            </div>
            <div class="col">
                <i class="fas fa-bolt"></i>
                <p>Electricistas</p>
            </div>
            <div class="col">
                <i class="fas fa-car"></i>
                <p>Mecánicos</p>
            </div>
            <div class="col">
                <i class="fas fa-drafting-compass"></i>
                <p>Arquitectos</p>
            </div>
            <div class="col">
                <i class="fas fa-gavel"></i>
                <p>Abogados</p>
            </div>
            <div class="col">
                <i class="fas fa-hotel"></i>
                <p>Hoteles</p>
            </div>
        </div>
    </div>
    <header id="header">
        <h1 class="colorR">Productos Añadidos</h1>
    </header>

    <main class="container mt-1">
        <div class="row justify-content-start mt-4" id="resultadosBusqueda">
            <!-- Aquí se mostrarán los resultados de búsqueda -->
        </div>
       <hr>  
        <div class="row justify-content-start" id="mostrarProductos">
            <!-- Aquí se mostrarán los productos -->
        </div>
    </main>

    <!-- Modal de imagen -->
    <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    <footer class="pie-pagina">
        <div class="grupo-1">
            <div class="box">
                <figure>
                    <a href="#">
                        <img src="../img/imagen_QGD-removebg-.png" alt="logo de sitio">
                    </a>
                </figure>
            </div>
            <div class="box">
                <h2>SOBRE NOSOTROS</h2>
                <p>Somos una entidad que busca la publicidad de lugares por medio de nuestro sitio web en la ciudad de Quibdó.</p>
                <p>Tu publicidad en nuestras manos.</p>
            </div> 
            <div class="box">
                <h2>Siguenos</h2>
                <div class="red-social">
                    <a href="https://www.facebook.com/" class="fa fa-facebook"></a>
                    <a href="https://www.instagram.com/" class="fa fa-instagram"></a>
                    <a href="https://twitter.com/" class="fa fa-twitter"></a>
                    <a href="https://www.whatsapp.com/?lang=es_LA" class="fa fa-whatsapp"></a>
                </div>
            </div>
        </div>
        <div class="grupo-2">
            <small>&copy; 2024 <b> Quibdó Guía Dorada</b> - Todos los Derechos Reservados</small>
        </div>
    </footer>

    <script src="../js/bootstrap.min.js"></script>
    <script>
        function obtenerAlmacenamientoLocal(llave) {
            const datos = JSON.parse(localStorage.getItem(llave));
            return datos;
        }
        
        let productos = obtenerAlmacenamientoLocal('productos') || [];
        
        window.addEventListener("load", () => {
            mostrarProductos(productos);
        
            const backgroundImages = [
                '../img/auto_repair.jpg',
                '../img/dentist.jpg',
                '../img/auto_repair2.jpg'
            ];
        
            const randomIndex = Math.floor(Math.random() * backgroundImages.length);
            const selectedImage = backgroundImages[randomIndex];
            document.getElementById('search-section').style.backgroundImage = `url(${selectedImage})`;
        });
        
        function mostrarProductos(productos, elementId = 'mostrarProductos') {
            let muestraProductos = document.getElementById(elementId);
            muestraProductos.innerHTML = '';
            for (let i = 0; i < productos.length; i++) {
                muestraProductos.innerHTML += `
                    <div class="card" style="display: inline-block;">
                        <center><div class="cardR">
                            <img src="${productos[i].urlImagen}" class="card-img-top" alt="${productos[i].nombre}" onclick="abrirModal('${productos[i].urlImagen}')">
                            <div class="card-body">
                                <h5 class="card-title">${productos[i].nombre}</h5>
                                <p class="card-text">${productos[i].reseña}</p>
                                <p class="card-text">${productos[i].dirección}</p>
                                <button class="btn btn-warning" onclick="verMas(${i})">Ver más</button>
                            </div>
                        </div></center>
                    </div>
                `;
            }
        }
        
        function verMas(index) {
            localStorage.setItem('productoSeleccionado', JSON.stringify(productos[index]));
            window.location.href = 'verqgd.html';
        }
        
        function abrirModal(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').style.display = "block";
        }
        
        function closeModal() {
            document.getElementById('imageModal').style.display = "none";
        }
        
        function buscarProductos() {
            const busqueda = document.getElementById('search-input').value.toLowerCase();
            const productosFiltrados = productos.filter(producto => {
                return producto.nombre.toLowerCase().includes(busqueda) ||
                       producto.categoria.toLowerCase().includes(busqueda);
            });
        
            // Ordenar productos por número de coincidencias
            productosFiltrados.sort((a, b) => {
                let aCoincidencias = 0;
                let bCoincidencias = 0;
        
                if (a.nombre.toLowerCase().includes(busqueda)) aCoincidencias++;
                if (b.nombre.toLowerCase().includes(busqueda)) bCoincidencias++;
                if (a.categoria.toLowerCase().includes(busqueda)) aCoincidencias++;
                if (b.categoria.toLowerCase().includes(busqueda)) bCoincidencias++;
        
                return bCoincidencias - aCoincidencias; // Ordenar de mayor a menor coincidencias
            });
        
            mostrarProductos(productosFiltrados, 'resultadosBusqueda');
        }
    </script>
</body>
</html>
