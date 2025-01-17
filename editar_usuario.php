<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo 'Usuario no encontrado';
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $proveedor = $_POST['proveedor'];
    $nombre = $_POST['nombre'];
    $primer_apellido = $_POST['primer_apellido'];
    $segundo_apellido = $_POST['segundo_apellido'];
    $telefono = $_POST['telefono'];
    $cod_postal = $_POST['cod_postal'];
    $direccion = $_POST['direccion'];
    $articulo = $_POST['articulo'];    
    $email = $_POST['email'];
    $nota = $_POST['nota'];
    // Si el campo nota está vacío, se convierte en NULL
    $nota = !empty($_POST['nota']) ? $_POST['nota'] : null;
    $colorFondo = $_POST['colorFondo'];
    $colorLetra = $_POST['colorLetra'];

    $sql = "UPDATE usuarios 
            SET proveedor = :proveedor, nombre = :nombre, primer_apellido = :primer_apellido, segundo_apellido = :segundo_apellido, 
                telefono = :telefono, cod_postal = :cod_postal, direccion = :direccion, email = :email, articulo = :articulo, nota = :nota, colorFondo = :colorFondo, colorLetra = :colorLetra
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':proveedor' => $proveedor,
        ':nombre' => $nombre,
        ':primer_apellido' => $primer_apellido,
        ':segundo_apellido' => $segundo_apellido,
        ':telefono' => $telefono,
        ':cod_postal' => $cod_postal,
        ':direccion' => $direccion,
        ':articulo' => $articulo,
        ':email' => $email,
        ':nota' => $nota,
        ':id' => $id,
        ':colorFondo' => $colorFondo, 
        ':colorLetra' => $colorLetra 
    ]);

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="editar.css"> 
</head>
<body>
    <header>
        <h1>Editar Usuario</h1>
    </header>

    <div class="container">
        <form action="editar_usuario.php" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">

            <label for="nombre">Proveedor:</label>
            <input type="text" id="proveedor" name="proveedor" value="<?= htmlspecialchars($usuario['proveedor']) ?>" required>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>

            <label for="primer_apellido">Primer Apellido:</label>
            <input type="text" id="primer_apellido" name="primer_apellido" value="<?= htmlspecialchars($usuario['primer_apellido']) ?>" required>

            <label for="segundo_apellido">Segundo Apellido:</label>
            <input type="text" id="segundo_apellido" name="segundo_apellido" value="<?= htmlspecialchars($usuario['segundo_apellido']) ?>">

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>" required>

            <label for="cod_postal">Código Postal:</label>
            <input type="number" id="cod_postal" name="cod_postal" value="<?= htmlspecialchars($usuario['cod_postal']) ?>" required>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($usuario['direccion']) ?>" required>

            <label for="nombre">Artículo:</label>
            <input type="text" id="articulo" name="articulo" value="<?= htmlspecialchars($usuario['articulo']) ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

            <label for="nota">Nota:</label>
            <input type="text" id="nota" name="nota" value="<?= htmlspecialchars($usuario['nota']) ?>" >

            <label for="colorFondo">Color de fondo:</label> <br/>
            <input type="color" id="colorFondo" name="colorFondo" value="<?= htmlspecialchars($usuario['colorFondo']) ?>" ><br/>
            <label for="colorLetra">Color de letra:</label><br/>
            <input type="color" id="colorLetra" name="colorLetra" value="<?= htmlspecialchars($usuario['colorLetra']) ?>" >           

            <input type="submit" value="Actualizar Usuario" class="btn">
            <a href="index.php" class="btn cancelar">Cancelar</a>
        </form>
    </div>
</body>
</html>
