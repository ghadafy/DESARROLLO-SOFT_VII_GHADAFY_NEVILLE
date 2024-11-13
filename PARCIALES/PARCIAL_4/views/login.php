<!-- Fila de login centrada -->
<div class="row">
    <div class="col s12 m6 l4 offset-m3 offset-l4">
        <!-- Tarjeta de Login -->
        <div class="card">
            <div class="card-content">
                <span class="card-title center-align ">
                    <h6>Iniciar Sesión si estás registrado</h6>
                </span>

                <!-- Formulario de Login -->
                <form action="#" method="POST">
                    <!-- Campo de Usuario -->
                    <div class="input-field">

                        <input id="email" type="email" name="email" required>
                        <label for="email">Correo Electrónico</label>
                    </div>


                    <!-- Botón de Login -->
                    <div class="input-field center-align">
                        <button type="submit" class="btn waves-effect light-blue #01579b light-blue darken-4">Entrar</button>
                    </div>

                    <!-- Enlace de Olvidé mi contraseña -->
                    <div class="center-align">
                        <a href="#"> - o - </a>
                        <!-- Botón de inicio de sesión de Google -->
                        <div id="g_id_onload" data-client_id="528282339510-0g5fv2f34pjst8pcl5otq09c3700ljck.apps.googleusercontent.com" data-callback="handleCredentialResponse">
                        </div>

                        <div class="g_id_signin" data-type="standard" data-size="large" data-theme="outline" data-text="sign_in_with" data-shape="rectangular" data-logo_alignment="left">
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
</div>

<!-- Enlace al JS de Materialize descargado -->
<script src="resources/js/materialize.js"></script>

<!-- Enlace a jQuery si es necesario (Materialize depende de jQuery) -->
<script src="resources/js/jquery.js"></script>


<script>
    // Inicialización de Materialize JS (por si se necesitan algunos componentes interactivos)
    document.addEventListener('DOMContentLoaded', function() {
        M.AutoInit();
    });
</script>