<?php require("header.php"); require("funciones.php"); ?>

<div id="tabla_usuarios">
    <?php echo consultar_datos($con); ?>
</div>

<div id="btn_container">
    <button id="btn_agregar_usuario">Agregar Usuario</button>
</div>
<div id="modal_form">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form id="form_usuario">
                    <input type="hidden" id="id_usuarios" name="id_usuarios">

                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" id="telefono" name="telefono" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="correo_electronico">Correo Electrónico:</label>
                        <input type="email" id="correo_electronico" name="correo_electronico" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="nombre_de_usuario">Nombre de Usuario:</label>
                        <input type="text" id="nombre_de_usuario" name="nombre_de_usuario" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="contrasenia">Contraseña:</label>
                        <input type="password" id="contrasenia" name="contrasenia" class="form-control">
                    </div>

                    <button type="submit" id="submit_btn" class="btn btn-primary">Guardar</button>
                    <button type="button" id="cancel_btn" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require("footer.php"); ?>