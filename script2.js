document.getElementById("from-regis").addEventListener("submit", function(event) {
    event.preventDefault(); // Detener el envío del formulario inicialmente

    // Obtener los valores de los campos
    const nombreUsuario = document.getElementById("nombre_de_usuario").value.trim();
    const nombre = document.getElementById("nombre").value.trim();
    const telefono = document.getElementById("telefono").value.trim();
    const fechaNacimiento = document.getElementById("fecha_nacimiento").value;
    const correoElectronico = document.getElementById("correo_electronico").value.trim();
    const contrasenia = document.getElementById("contrasenia").value.trim();

    // Validar nombre de usuario (solo letras, números y guion bajo)
    const usernamePattern = /^[a-zA-Z0-9_]+$/;
    if (!usernamePattern.test(nombreUsuario)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El nombre de usuario solo puede contener letras, números y guion bajo.',
        });
        return;
    }

    // Validar nombre (solo letras)
    const namePattern = /^[a-zA-Z\s]+$/;
    if (!namePattern.test(nombre)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El nombre solo puede contener letras.',
        });
        return;
    }

    // Validar teléfono (solo números)
    const phonePattern = /^[0-9]+$/;
    if (!phonePattern.test(telefono)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El teléfono solo puede contener números.',
        });
        return;
    }

    // Validar fecha de nacimiento (mayor de 13 años)
    const birthDate = new Date(fechaNacimiento);
    const currentDate = new Date();
    let age = currentDate.getFullYear() - birthDate.getFullYear();
    const monthDiff = currentDate.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && currentDate.getDate() < birthDate.getDate())) {
        age--;
    }
    if (age < 13) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Debes tener al menos 13 años para registrarte.',
        });
        return;
    }

    // Validar contraseña (8 caracteres, una mayúscula, una minúscula, un número y un carácter especial)
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/;
    if (!passwordPattern.test(contrasenia)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.',
        });
        return;
    }

    // Verificar si el nombre de usuario o correo electrónico ya existen en la base de datos
    fetch(`verificar_usuario.php?nombre_de_usuario=${nombreUsuario}&correo_electronico=${correoElectronico}`)
        .then(response => response.json())
        .then(data => {
            if (data.existe) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El nombre de usuario o correo electrónico ya existe. Por favor, elige otros.',
                });
            } else {
                // Si todas las validaciones pasan y no hay duplicados, se envía el formulario
                document.getElementById("from-regis").submit();
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al verificar los datos: ' + error,
            });
        });
});