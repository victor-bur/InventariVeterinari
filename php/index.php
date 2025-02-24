<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projecte Veterinari</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=pets" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=login" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=login" />
    <body>
    <nav class="navbar">
        <span class="material-symbols-outlined" id="logo"><a href="../index.html">pets</a></span>
        <ul class="list">
            <li><a href="#">Sobre nosaltres</a></li>
            <li><a href="#">Posa't en contacte</a></li>
            <li><a href="#">Consulta els nostres productes</a></li>
            <span class="material-symbols-outlined" id="login_btn"><a href="#login">login</a></span>
        </ul>
    </nav>
    <div id="login">
        <form action="login.php" method="post">
      <label for="username">Nom d'usuari:</label>
      <input type="text" id="username" name="username" required><br>
       
      <label for="contrasenya">contrasenya:</label>
      <input type="password" id="contrasenya" name="contrasenya" required><br>
      <a href="register.php">No tens compte d'usuari? Creala</a>
      <input type="submit" value="Inicia sessió">
    </form>
        </div>
</body>
</html>
