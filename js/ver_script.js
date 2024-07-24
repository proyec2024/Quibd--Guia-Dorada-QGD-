function guardarAlmacenamientoLocal(llave, valor_a_guardar) {
    localStorage.setItem(llave, JSON.stringify(valor_a_guardar))
}

function obtenerAlmacenamientoLocal(llave) {
    const datos = JSON.parse(localStorage.getItem(llave))
    return datos
}

let productos = obtenerAlmacenamientoLocal('productos') || [];
let mensaje = document.getElementById('mensaje')

// Añadir un producto
const añadirProducto = document.getElementById('productoAñadir')
const añadirReseña = document.getElementById('reseñaAñadir')
const añadirDireccion = document.getElementById('direccionAñadir')
const añadirContacto = document.getElementById('contactoAñadir')
const añadirCategoria = document.getElementById('categoriaAñadir')
const añadirImagen = document.getElementById('ImagenAñadir')
const añadirImagenesSecundarias = document.getElementById('imagenesSecundariasAñadir')
const añadirServicios = document.getElementById('serviciosAñadir')
const añadirHorarios = document.getElementById('horariosAñadir')

document.getElementById("botonAñadir").addEventListener("click", function (event) {
    event.preventDefault()
    let productoAñadir = añadirProducto.value
    let reseñaAñadir = añadirReseña.value
    let direccionAñadir = añadirDireccion.value
    let contactoAñadir = añadirContacto.value
    let categoriaAñadir = añadirCategoria.value
    let imagenAñadir = añadirImagen.files[0]
    let imagenesSecundarias = Array.from(añadirImagenesSecundarias.files)
    let serviciosAñadir = añadirServicios.value
    let horariosAñadir = añadirHorarios.value

    if (productoAñadir == '' || reseñaAñadir == '' || direccionAñadir == '' || !imagenAñadir || contactoAñadir == '' || categoriaAñadir == '' || serviciosAñadir == '' || horariosAñadir == '') {
        mensaje.classList.add('llenarCampos')
        setTimeout(() => { mensaje.classList.remove('llenarCampos') }, 2500)
    } else {
        let van = true
        for (let i = 0; i < productos.length; i++) {
            if (productos[i].nombre == productoAñadir) {
                mensaje.classList.add('repetidoError')
                setTimeout(() => { mensaje.classList.remove('repetidoError') }, 2500)
                van = false
                break
            }
        }

        if (van) {
            let reader = new FileReader();
            reader.onload = function (e) {
                let imagenSecundariasUrls = []
                let imagenSecundariaPromises = imagenesSecundarias.map(file => {
                    return new Promise((resolve, reject) => {
                        let reader = new FileReader();
                        reader.onload = function (e) {
                            imagenSecundariasUrls.push(e.target.result);
                            resolve();
                        }
                        reader.onerror = reject;
                        reader.readAsDataURL(file);
                    });
                });

                Promise.all(imagenSecundariaPromises).then(() => {
                    productos.push({
                        nombre: productoAñadir,
                        reseña: reseñaAñadir,
                        dirección: direccionAñadir,
                        contacto: contactoAñadir,
                        categoria: categoriaAñadir,
                        urlImagen: e.target.result,
                        imagenesSecundarias: imagenSecundariasUrls,
                        servicios: serviciosAñadir,
                        horarios: horariosAñadir
                    });
                    guardarAlmacenamientoLocal('productos', productos);
                    mensaje.classList.add('realizado')
                    setTimeout(() => {
                        mensaje.classList.remove('realizado')
                        window.location.reload()
                    }, 1500)
                });
            }
            reader.readAsDataURL(imagenAñadir);
        }
    }
})

function actualizarListaProductos() {
    let productoEliminar = document.getElementById('productoEliminar')
    let productoEditar = document.getElementById('productoEditar')
    productoEliminar.innerHTML = '<option value="">---</option>'
    productoEditar.innerHTML = '<option value="">---</option>'
    productos.forEach(producto => {
        let opcionEliminar = document.createElement('option')
        opcionEliminar.value = producto.nombre
        opcionEliminar.textContent = producto.nombre
        productoEliminar.appendChild(opcionEliminar)

        let opcionEditar = document.createElement('option')
        opcionEditar.value = producto.nombre
        opcionEditar.textContent = producto.nombre
        productoEditar.appendChild(opcionEditar)
    })
}

actualizarListaProductos()


// Editar
const editarProducto = document.getElementById('productoEditar')
const atributoEditar = document.getElementById('atributoEditar')
const nuevoAtributo = document.getElementById('nuevoAtributo')

document.getElementById('botonEditar').addEventListener('click', function (event) {
    event.preventDefault()
    let productoSeleccionado = editarProducto.value
    let atributoSeleccionado = atributoEditar.value
    let nuevoValor = nuevoAtributo.value

    if (productoSeleccionado === '' || atributoSeleccionado === '' || nuevoValor === '') {
        mensaje.classList.add('llenarCampos')
        setTimeout(() => { mensaje.classList.remove('llenarCampos') }, 2500)
    } else {
        let producto = productos.find(p => p.nombre === productoSeleccionado)
        if (producto) {
            if (atributoSeleccionado === 'imagen') {
                let nuevaImagen = nuevoAtributo.files[0]
                let reader = new FileReader()
                reader.onload = function (e) {
                    producto.urlImagen = e.target.result
                    guardarAlmacenamientoLocal('productos', productos)
                    mensaje.classList.add('realizado')
                    setTimeout(() => {
                        mensaje.classList.remove('realizado')
                        window.location.reload()
                    }, 1500)
                }
                reader.readAsDataURL(nuevaImagen)
            } else {
                producto[atributoSeleccionado] = nuevoValor
                guardarAlmacenamientoLocal('productos', productos)
                mensaje.classList.add('realizado')
                setTimeout(() => {
                    mensaje.classList.remove('realizado')
                    window.location.reload()
                }, 1500)
            }
        }
    }
})


// Eliminar
const eliminarProducto = document.getElementById('productoEliminar')

document.getElementById('botonEliminar').addEventListener('click', function (event) {
    event.preventDefault()
    let productoSeleccionado = eliminarProducto.value

    if (productoSeleccionado === '') {
        mensaje.classList.add('llenarCampos')
        setTimeout(() => { mensaje.classList.remove('llenarCampos') }, 2500)
    } else {
        productos = productos.filter(p => p.nombre !== productoSeleccionado)
        guardarAlmacenamientoLocal('productos', productos)
        mensaje.classList.add('realizado')
        setTimeout(() => {
            mensaje.classList.remove('realizado')
            window.location.reload()
        }, 1500)
    }
})

// Mostrar productos
window.addEventListener("load", () => {
    const productoEd = document.getElementById('productoEditar')
    const productoEl = document.getElementById('productoEliminar')
    for (let i = 0; i < productos.length; i++) {
        productoEd.innerHTML += `<option>${productos[i].nombre}</option>`
        productoEl.innerHTML += `<option>${productos[i].nombre}</option>`
    }
    [].forEach(element => {
        atributoEd.innerHTML += `<option value="${element}">${element.charAt(0).toUpperCase() + element.slice(1)}</option>`
    });

    let mostraProductos = document.getElementById('mostrarProductos')
    mostraProductos.innerHTML = ''
    for (let i = 0; i < productos.length; i++) {
        mostraProductos.innerHTML += `
            <div class="contenedorProductos">
                <img src="${productos[i].urlImagen}">
                <div class="informacion">
                    <p>${productos[i].nombre}</p>
                    <p class="precio"><span>Reseña: ${productos[i].reseña}</span></p>
                    <p>Dirección: ${productos[i].dirección}</p>
                    <p>Servicios: ${productos[i].servicios}</p>
                </div>
            </div>`
    }
})


