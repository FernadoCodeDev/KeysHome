<?php 
// Iniciar la sesión
session_start();

// Conexión a la base de datos
include 'includes/Config/DataBases.php';
$DB = conectarDB(); // Base de datos conectada 

// Navegación
include './includes/templades/Navegacion.php';

// Autenticar el usuario
$errores = []; // Variable para el mensaje de error
$exito = ''; // Variable para el mensaje de éxito

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    // Validar email
    $email = mysqli_real_escape_string($DB, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($DB, $_POST['password']);

    if (!$email) {
        $errores[] = "El email es obligatorio o no es válido";
    }

    if (!$password) {
        $errores[] = "El password es obligatorio";
    }

    if (empty($errores)) {
        // Revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email = '${email}'"; // Corrige aquí
        $resultado = mysqli_query($DB, $query);

        // Manejo de error en la consulta
        if (!$resultado) {
            die("Error en la consulta: " . mysqli_error($DB));
        }

        // var_dump($query);

        if ($resultado->num_rows) {
            // Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);

            // Verificar si el password es correcto
            $auth = password_verify($password, $usuario['password']);

            // var_dump($auth);

            if ($auth) {
                // Usuario autenticado 
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                // Redirigir al usuario
                header('Location: Admin/Propiedades/Administrador.php');
            } else {
                $errores[] = "El password es incorrecto";
            }
        } else {
            $errores[] = "El Usuario No Existe";
        }
    }
}

// Mostrar los mensajes de error o éxito
if (!empty($errores)) {
    foreach ($errores as $error) {
        echo "<p class='mensaje-error'>$error</p>";
    }
} else if ($exito) {
    echo "<p class='mensaje-exito'>$exito</p>"; 
}
?>



<section class="nosotros">
       
        <!-- Formulario-->
        <div class="formulario-sugerencias">
          <h2>Iniciar Sesión</h2>
          <form action="#" method="POST">
    
            <div class="user-box">
              <input type="email" id="email" name="email" >
              <label for="email">Coloca Tú Email</label>
            </div>

            <div class="user-box">
              <input type="password" id="password" name="password" >
              <label for="password">Coloca Tú Password</label>
            </div>
        
            
            <button type="submit" class="Enviar">Iniciar sesión</button>
          </form>
        </div>
        
        <!-- Agradecimiento -->
      </section>

<!--footer.scss-->

<?php
  include './includes/templades/footer.php';
?>
    
    <script src="/build/js/bundle.min.js"></script>

</body>
</html>