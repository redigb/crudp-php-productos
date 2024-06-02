// CARGA de la TABLA
//
//
//
//-> TABLA COLOR
window.addEventListener('DOMContentLoaded', cargarColores);

function cargarColores() {
    let xhr = new XMLHttpRequest();
    // Verificar el tipo de envio en este caso GET + accion especifica colorListaCategoria
    let url = APP_URL + 'App/ajax/colorAjax.php?accion=cargarListaColor';
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let res = xhr.responseText;
            let colores = JSON.parse(res);
            let template = '';
            let count = 1;
            // let nombre = "";
            colores.forEach(function (color) {
                let fechaActualizada = new Date(color.color_actualizado).toLocaleDateString('es-ES', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit'
                });

                nombre = color.nombre_color;

            
                template += '<tr class="border-b hover:bg-gray-100">' +
                    '<td class="px-4 py-3">N° ' + count + '</td>' +
                    '<td class="px-4 py-3">' + color.codigo_color + '</td>' +
                    '<td class="px-4 py-3 text-right">' + color.nombre_color + '</td>' +
                    '<td class="px-4 py-3 text-right">' + fechaActualizada + '</td>' +
                    '<td class="px-4 py-3 text-right">' +
                     
                    `<button onclick="eliminarColor(${color.color_id }, '${encodeURIComponent(nombre)}')" type="button" class="text-red-700 border border-red-700 hover:bg-red-700 hover:text-white  font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800 dark:hover:bg-red-500">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="m20.37 8.91l-1 1.73l-12.13-7l1-1.73l3.04 1.75l1.36-.37l4.33 2.5l.37 1.37zM6 19V7h5.07L18 11v8a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2"/></svg>
                        <span class="sr-only">Icon Eliminar</span>
                    </button>` +
                    
                    '</td>' +
                    '</tr>';
                count++;
            });
            document.getElementById('tabla-colores').innerHTML = template;
        }
    };
    xhr.send();
}

function eliminarColor(id, nombreCategoria) {
    let xhr = new XMLHttpRequest();
    let url = APP_URL + 'App/ajax/colorAjax.php';
    Swal.fire({
        title: "Quieres eliminar la categoria?",
        text: "Eliminarás el color '"+nombreCategoria+"' y no podrás recuperarla",
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
                    cargarColores();
                }
            };
            xhr.send('accion=eliminarColor&id=' + id);
        }
    });
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