<?php
// Inicializar la sesión.
// Si está usando session_name("algo"), ¡no lo olvide ahora!
session_start();

// Finalmente, destruir la sesión.
session_destroy();

// redirreciona login
header('Location: ../index.php');
exit;
?>