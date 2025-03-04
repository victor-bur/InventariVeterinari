<?php
include 'db.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $nom = trim($_POST['nom']);
    $cognoms = trim($_POST['cognoms']);
    $contrasenya = trim($_POST['contrasenya']);
    $email = trim($_POST['email']);

    // Validaciones
    if (empty($username) || empty($nom) || empty($cognoms) || empty($contrasenya) || empty($email)) {
        $error = "Tots els camps són obligatoris";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format d'email invàlid";
    } elseif (strlen($username) > 50 || strlen($nom) > 50 || strlen($cognoms) > 50 || strlen($contrasenya) > 50 || strlen($email) > 50) {
        $error = "Els camps no han d'excedir els 50 caràcters";
    } else {
        // Verificar usuario existente
        $stmt = $conn->prepare("SELECT id_usuari FROM usuaris WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $error = "L'usuari o email ja estan registrats";
        } else {
            // Hash MD5
            $hashedPassword = md5($contrasenya);
            
            // Insertar usuario
            $stmt = $conn->prepare("INSERT INTO usuaris (username, Nom, Cognoms, contrasenya, email) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $nom, $cognoms, $hashedPassword, $email);
            
            if ($stmt->execute()) {
                $success = "Registre exitós!";
                header("refresh:2; url=login.php");
            } else {
                $error = "Error en el registre: " . $conn->error;
            }
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
    <title>Registre - Projecte Veterinari</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=pets" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=login" />
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

    <div id="login">
        <h2>Crear compte nou</h2>

        <?php if ($error): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p class="success-message"><?php echo $success; ?></p>
        <?php endif; ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <label for="username">Nom d'usuari:</label>
                <input type="text" id="username" name="username" maxlength="50" required>
            </div>

            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" maxlength="50" required>
            </div>

            <div class="form-group">
                <label for="cognoms">Cognoms:</label>
                <input type="text" id="cognoms" name="cognoms" maxlength="50" required>
            </div>

            <div class="form-group">
                <label for="contrasenya">Contrasenya:</label>
                <input type="password" id="contrasenya" name="contrasenya" maxlength="50" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" maxlength="50" required>
            </div>

            <div class="form-actions">
                <a href="login.php">Ja tens compte? Inicia sessió</a>
                <input type="submit" value="Registra't">
            </div>
        </form>
    </div>
</body>
</html>
