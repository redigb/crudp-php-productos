//Solo AJAX
const formularios_ajax = document.querySelectorAll(".FormularioAjax");
// Recorrido a los formularios
formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit", function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Estas seguro?",
            text: "Quieres realizar esta acción solicitada?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, guardar",
            cancelButtonText: "No, cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                let data = new FormData(this);
                let method = this.getAttribute("method");
                let action = this.getAttribute("action");

                let header = new Headers();
                let config = {
                    method: method,
                    headers: header,
                    mode: "cors",
                    cache: "no-cache",
                    body: data
                }

                fetch(action, config)
                    .then(res => res.json())
                    .then(res => {
                        return alerta_ajax(res);
                    });
            }
        });
    });
});

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

// Boton de cerrar sesion
let btn_exit = document.getElementById("btn_exit");
btn_exit.addEventListener("click", function (e) {
    e.preventDefault();
    Swal.fire({
        title: "Quieres cerrar la sesión?",
        text: "Cerraras tu sesión y volverás a la página de inicio.",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, salir",
        cancelButtonText: "No, cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            // Pasar a la url definida
            let url = this.getAttribute("href");
            window.location.href = url;
        }
    });
});

// Mi modal js
function openModal() {
    document.getElementById('modal-js-editar').classList.remove('hidden');
    document.getElementById('modal-js-editar').classList.add('flex');
}

function closeModal() {
    document.getElementById('modal-js-editar').classList.remove('flex');
    document.getElementById('modal-js-editar').classList.add('hidden');
}

document.querySelectorAll('.modal-close').forEach((element) => {
    element.addEventListener('click', closeModal);
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeModal();
    }
});