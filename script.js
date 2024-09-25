// Inicio Script ABM
document.addEventListener("DOMContentLoaded", function() {
    const modalForm = document.getElementById("modal_form");
    const formUsuario = document.getElementById("form_usuario");

    document.getElementById("btn_agregar_usuario").addEventListener("click", function() {
        formUsuario.reset();
        document.getElementById("id_usuarios").value = "";
        document.getElementById("submit_btn").value = "Agregar";
        formUsuario.action = "funciones.php";
        formUsuario.setAttribute("data-action", "agregar");
        modalForm.style.display = "block";
    });

    document.getElementById("cancel_btn").addEventListener("click", function() {
        modalForm.style.display = "none";
    });

    window.actualizarUsuario = function(id) {
        fetch(`obtener_usr_datos.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.error,
                    });
                } else {
                    document.getElementById("id_usuarios").value = data.id_usuarios;
                    document.getElementById("telefono").value = data.telefono;
                    document.getElementById("nombre").value = data.nombre;
                    document.getElementById("fecha_nacimiento").value = data.fecha_nacimiento;
                    document.getElementById("correo_electronico").value = data.correo_electronico;
                    document.getElementById("nombre_de_usuario").value = data.nombre_de_usuario;
    
                    document.getElementById("contrasenia").value = "********";
                    
                    modalForm.style.display = "block";
                    document.getElementById("submit_btn").value = "Actualizar";
                    formUsuario.action = "funciones.php";
                    formUsuario.setAttribute("data-action", "actualizar");
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "Hubo un problema con la solicitud: " + error,
                });
            });
    };

    window.eliminarUsuario = function(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esto.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                formUsuario.reset();
                document.getElementById("id_usuarios").value = id;
                formUsuario.action = "funciones.php";
                formUsuario.setAttribute("data-action", "eliminar");
                enviarFormulario();
                Swal.fire(
                    'Eliminado',
                    'El usuario ha sido eliminado.',
                    'success'
                );
            }
        });
    };
    

    formUsuario.addEventListener("submit", function(e) {
        e.preventDefault();
        verificarDatos();
    });

    function verificarDatos() {
        const telefono = document.getElementById("telefono").value.trim();
        const nombre = document.getElementById("nombre").value.trim();
        const fechaNacimiento = document.getElementById("fecha_nacimiento").value.trim();
        const email = document.getElementById("correo_electronico").value.trim();
        const nombreUser = document.getElementById("nombre_de_usuario").value.trim();
        const contrasenia = document.getElementById("contrasenia").value.trim();
    
        if (!telefono || !nombre || !fechaNacimiento || !email || !nombreUser || !contrasenia) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Todos los campos son obligatorios.',
            });
            return;
        }
    
        const hoy = new Date();
        const fechaNacimientoDate = new Date(fechaNacimiento);
    
        if (fechaNacimientoDate > hoy) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La fecha de nacimiento no puede ser mayor al año actual.',
            });
            return;
        }
    
        const edad = hoy.getFullYear() - fechaNacimientoDate.getFullYear();
        const mes = hoy.getMonth() - fechaNacimientoDate.getMonth();
        if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimientoDate.getDate())) {
            edad--;
        }
    
        if (edad < 0 || edad > 120) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, ingresa una fecha de nacimiento válida (0-120 años).',
            });
            return;
        }
    
        const id = document.getElementById("id_usuarios").value;
        fetch(`verificar_datos.php?email=${email}&nombreUser=${nombreUser}&id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.existe) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'El correo electrónico o nombre de usuario ya existe.',
                    });
                } else {
                    enviarFormulario();
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "Hubo un problema con la verificación: " + error,
                });
            });
    }
    

    function enviarFormulario() {
        const formData = new FormData(formUsuario);
        formData.append(formUsuario.getAttribute("data-action"), true);
        fetch(formUsuario.action, {
            method: "POST",
            body: formData
        }).then(response => response.text())
        .then(result => {
            modalForm.style.display = "none";
            document.getElementById("tabla_usuarios").innerHTML = result;
        });
    }
});
// Fin Script ABM

// Inicio Script Busqueda evento
const formularioBusqueda = document.getElementById("form-buscar-evento");
const resultadoDiv = document.getElementById('resultado');

formularioBusqueda.addEventListener("submit", consultar_en_tiempo_real);

function consultar_en_tiempo_real(evento) {
    
    // Evita que se recargue la página
    evento.preventDefault();

    // Obtener el ultimo valor del input
    const nombre_evento = document.getElementById("evento").value;

    //se crea un objeto para tomar los valores del formulario
    const formData = new FormData();
    formData.append('evento', nombre_evento);
    formData.append('envio2', true);

    // se le pasa al fetch el endpoint que genera la consulta de busqueda
    fetch('buscar_evento.php', {
        method: 'POST',
        body: formData
    })

    //se toma la respuesta y se devuelve en formato json
    .then(response => response.json())
    //la variable data se usa para recorrer el array asociativo del endpoint...
    .then(data => {
        
        resultadoDiv.innerHTML = ""; // Limpia el contenido previo

        //si el enpoint devuelve 1...
        if (data.status === 1) {
            data.eventos.forEach(event => {
                // se agrega html dentro del div que contiene el mensaje de respuesta
                resultadoDiv.innerHTML += `
                <div class="evento-card">
                    <h2 class="evento-nombre">${event.nombre}</h2>
                    <div class="evento-info">
                        <p><strong>Fecha:</strong> ${event.fecha}</p>
                        <p><strong>Hora:</strong> ${event.hora}</p>
                        <p><strong>Lugar:</strong> ${event.lugar}</p>
                        <p><strong>Precio:</strong> ${event.precio}</p>
                        <p><strong>Rango de Edad:</strong> ${event.rango}</p>
                    </div>
                    <hr>
                </div>`;
                
            });
        }  else {
            resultadoDiv.innerHTML = `<p>${data.mensaje}</p>`;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
// Fin Script Busqueda evento

