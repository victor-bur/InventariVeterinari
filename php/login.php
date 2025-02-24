<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $contrasenya = $_POST['contrasenya'];

  echo "¡Hola, $username! La teva contrasenya es: $contrasenya";
}
?>



