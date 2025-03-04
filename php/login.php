<?php
session_start();
include 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $contrasenya = trim($_POST['contrasenya']);

    if (empty($username) || empty($contrasenya)) {
        $error = "Els camps són obligatoris";
    } else {
        // Buscar usuario
        $stmt = $conn->prepare("SELECT id_usuari, contrasenya FROM usuaris WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $storedHash = $row['contrasenya'];
            $inputHash = md5($contrasenya); // Generar hash MD5 del input
            
            if ($inputHash === $storedHash) {
                $_SESSION['user_id'] = $row['id_usuari'];
                header("Location: home.php");
                exit();
            } else {
                $error = "Contrasenya incorrecta";
            }
        } else {
            $error = "Usuari no trobat";
        }
        $stmt->close();
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inici de Sessió - Veterinari</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
</head>
<body>
    <nav class="navbar">
        <span class="material-symbols-outlined" id="logo"><a href="../index.html">pets</a></span>
        <ul class="list">
            <li><a href="#">Sobre nosaltres</a></li>
            <li><a href="#">Posa't en contacte</a></li>
            <li><a href="#">Consulta els nostres productes</a></li>
            <span class="material-symbols-outlined" id="login_btn"><a href="login.php">login</a></span>
        </ul>
    </nav>

    <div class="container">
        <div id="login">
            <h2>Inici de Sessió</h2>

            <?php if ($error): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group">
                    <label for="username">Nom d'usuari:</label>
                    <input type="text" id="username" name="username" maxlength="50" required>
                </div>

                <div class="form-group">
                    <label for="contrasenya">Contrasenya:</label>
                    <input type="password" id="contrasenya" name="contrasenya" maxlength="50" required>
                </div>

                <div class="form-actions">
                    <input type="submit" value="Inicia Sessió" class="btn-primary">
                    <a href="register.php" class="link-secondary">No tens compte? Registra't</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
