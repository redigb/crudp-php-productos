// CARGA de la TABLA
//
//
//
//-> TABLA PRODUCTO
window.addEventListener('DOMContentLoaded', CargarProductos);
window.addEventListener('DOMContentLoaded', cargarListaCategoria);
window.addEventListener('DOMContentLoaded', cargarListaMedida);
window.addEventListener('DOMContentLoaded', cargarListaColor);


function CargarProductos() {
    let xhr = new XMLHttpRequest();
    // Verificar el tipo de envio en este caso GET + accion especifica cargarListaCategoria
    let url = APP_URL + 'App/ajax/productoAjax.php?accion=cargarListaProducto';
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let res = xhr.responseText;
            let productos = JSON.parse(res);
            let template = '';
            let count = 1;
            // let nombre = "";
            productos.forEach(function (producto) {
                let fechaActualizada = new Date(producto.producto_actualizado).toLocaleDateString('es-ES', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit'
                });

                nombre = producto.nombre_producto;

                template += '<tr class="border-b hover:bg-gray-100">' +
                    '<td class="px-4 py-3">N° ' + count + '</td>' +
                    '<td class="px-4 py-3">' + producto.nombre_producto + '</td>' +
                    '<td class="px-4 py-3 text-right">' + producto.otros_datos + '</td>' +
                    '<td class="px-4 py-3 text-right">' + producto.categoria_nombre + '</td>' +
                    '<td class="px-4 py-3 text-right">' + producto.codigo_tamaño + '</td>' +
                    '<td class="px-4 py-3 text-right">' + producto.nombre_color + '</td>' +
                    '<td class="px-4 py-3 text-right">' + fechaActualizada + '</td>' +
                    '<td class="px-4 py-3 text-right">' +
                    `<button type="button" data-producto='${JSON.stringify(producto)}' class="js-modal-rdtr text-green-700 border border-green-700 hover:bg-green-700 hover:text-white font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:focus:ring-green-800 dark:hover:bg-green-500">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M10 15q-.425 0-.712-.288T9 14v-2.425q0-.4.15-.763t.425-.637l8.6-8.6q.3-.3.675-.45t.75-.15q.4 0 .763.15t.662.45L22.425 3q.275.3.425.663T23 4.4t-.137.738t-.438.662l-8.6 8.6q-.275.275-.637.438t-.763.162zm9.6-9.2l1.425-1.4l-1.4-1.4L18.2 4.4zM5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h6.5q.35 0 .575.175t.35.45t.087.55t-.287.525l-4.65 4.65q-.275.275-.425.638T7 10.75V15q0 .825.588 1.412T9 17h4.225q.4 0 .763-.15t.637-.425L19.3 11.75q.25-.25.525-.288t.55.088t.45.35t.175.575V19q0 .825-.587 1.413T19 21z"/></svg>
                        <span class="sr-only">Icon Editar</span>
                    </button>` +

                    `<button onclick="eliminarProducto(${producto.producto_id}, '${encodeURIComponent(nombre)}')" type="button" class="text-red-700 border border-red-700 hover:bg-red-700 hover:text-white  font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800 dark:hover:bg-red-500">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="m20.37 8.91l-1 1.73l-12.13-7l1-1.73l3.04 1.75l1.36-.37l4.33 2.5l.37 1.37zM6 19V7h5.07L18 11v8a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2"/></svg>
                        <span class="sr-only">Icon Eliminar</span>
                    </button>` +
                    '</td>' +
                    '</tr>';
                count++;
            });
            document.getElementById('tabla-productos').innerHTML = template;

            // Añadir datos al formulario editar
           document.querySelectorAll('.js-modal-rdtr').forEach(($trigger) => {
                $trigger.addEventListener('click', () => {
                    const producto = JSON.parse($trigger.dataset.producto);
                    console.log(producto.nombre_producto); 
                    console.log(producto.producto_id);
                    document.getElementById('id_ProductEdit').value = producto.producto_id;
                    document.getElementById('nombre_producto_editar').value = producto.nombre_producto;
                    document.getElementById('otros_datos_editar').value = producto.otros_datos;
                    document.getElementById('categoriaSelect').value = producto.categoria_id;
                    document.getElementById('medida_selecionEdit').value = producto.medida_id;
                    document.getElementById('color_selecionEdit').value = producto.color_id;
                    // Asignar otros valores al formulario según sea necesario    
                    openModal();
                });
            });
        }
    };
    xhr.send();
}


// AJax eliminar categoria
function eliminarProducto(id, nombre) {
    let xhr = new XMLHttpRequest();
    let url = APP_URL + 'App/ajax/productoAjax.php';
    Swal.fire({
        title: "Quieres eliminar la categoria?",
        text: "Eliminarás la categoría '" + nombre + "' y no podrás recuperarla",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, eliminar"
    }).then((result) => {
        if (result.isConfirmed) {
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    Jsonresponse = JSON.parse(xhr.responseText);
                    alerta_ajax(Jsonresponse);
                    // Recargar la lista de categorías después de eliminar
                    CargarProductos();
                }
            };
            xhr.send('accion=eliminarProducto&id=' + id);
        }
    });
}
// AJax editar producto
function editarProducto(id, nombre) {
    let xhr = new XMLHttpRequest();
    let url = APP_URL + 'App/ajax/productoAjax.php';
    Swal.fire({
        title: "Quieres editar el producto?",
        text: "Editarás el producto '" + nombre + "' y no podrás recuperarlo",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, editar",
        cancelButtonText: "No, editar"
    }).then((result) => {
        if (result.isConfirmed) {
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    Jsonresponse = JSON.parse(xhr.responseText);
                    alerta_ajax(Jsonresponse);
                    // Recargar la lista de categorías después de eliminar
                    CargarProductos();
                }
            };
            xhr.send('accion=editarProducto&id=' + id);
        }
    });
}
// Cargar consulta select
function cargarListaCategoria() {
    let xhr = new XMLHttpRequest();
    let url = APP_URL + 'App/ajax/categoriaAjax.php?accion=cargarListaCategoria';
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let res = xhr.responseText;
            let categorias = JSON.parse(res);
            let template = '<option value="">Seleccione categoria</option>';
            let count = 1;
            categorias.forEach(function (categoria) {
                template += '<option value="' + categoria.categoria_id + '">' + categoria.categoria_nombre + '</option>';
                count++;
            });
            document.getElementById('categoria_selecion').innerHTML = template;
            // --> Aquí, en lugar de renderizar la tabla, agregamos las opciones al selector de categorías
            document.getElementById('categoriaSelect').innerHTML = template;
        }
    };
    xhr.send();
}
// Cargar consulta select
function cargarListaMedida() {
    let xhr = new XMLHttpRequest();
    let url = APP_URL + 'App/ajax/medidaAjax.php?accion=cargarListaMedida';
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let res = xhr.responseText;
            let medidas = JSON.parse(res);
            let template = '<option value="">Selecione medida</option>'
            let count = 1;
            medidas.forEach(function (medida) {
                template += '<option value="' + medida.tamaño_id + '">' + medida.codigo_tamaño + '</option>';
                count++;
            });
            template += '</select>'
            // Aquí, en lugar de renderizar la tabla, agregamos las opciones al selector de categorías  
            document.getElementById('medida_selecion').innerHTML = template; 
            document.getElementById('medida_selecionEdit').innerHTML = template; 
        }
    };
    xhr.send();
}
function cargarListaColor() {
    let xhr = new XMLHttpRequest();
    let url = APP_URL + 'App/ajax/colorAjax.php?accion=cargarListaColor';
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let res = xhr.responseText;
            let colores = JSON.parse(res);
            let template = '<select name="color_id" id="color_id">';
            template += '<option value="">Selecione color</option>'
            let count = 1;
            colores.forEach(function (color) {
                template += '<option value="' + color.color_id + '">' + color.nombre_color + '</option>';
                count++;
            });
            template += '</select>'
            // Aquí, en lugar de renderizar la tabla, agregamos las opciones al selector de categorías
            document.getElementById('color_selecion').innerHTML = template;
            document.getElementById('color_selecionEdit').innerHTML = template;
        }
    };
    xhr.send();
}
// Messages de alerta
function alerta_ajax(aler) {
    if (aler.tipo == "simple") {
        Swal.fire({
            title: aler.titulo,
            text: aler.texto,
            icon: aler.icono,
            confirmButtonText: "Aceptar"
        });
    } else if (aler.tipo == "recargar") {
        Swal.fire({
            title: aler.titulo,
            text: aler.texto,
            icon: aler.icono,
            confirmButtonText: "Aceptar"
        }).then((res) => {
            if (res.isConfirmed) {
                location.reload();
            }
        });
    } else if (aler.tipo == "limpiar") {
        Swal.fire({
            title: aler.titulo,
            text: aler.texto,
            icon: aler.icono,
            confirmButtonText: "Aceptar"
        }).then((res) => {
            if (res.isConfirmed) {
                document.querySelector(".FormularioAjax").reset();
            }
        });
    } else if (aler.tipo == "redireccionar") {
        Window.location.href = aler.url;
    }
    // ajax personalisado redireccionar2
    else if (aler.tipo == "regresar") {
        Swal.fire({
            title: aler.titulo,
            text: aler.texto,
            icon: aler.icono,
            confirmButtonText: "Aceptar"
        }).then((res) => {
            if (res.isConfirmed) {
                // Verificar si la url es existente
                if (aler && aler.url) {
                    window.location.href = aler.url;
                } else {
                    console.error("Error en la url");
                }
            }
        });
    }
}