<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    $colorFondo = $_POST['colorFondo']; 
    $colorLetra = $_POST['colorLetra']; 
    // Modificar la consulta SQL para incluir el campo 'notas'
    $sql = "INSERT INTO usuarios (proveedor, nombre, primer_apellido, segundo_apellido, telefono, cod_postal, direccion, articulo, email, nota, fecha_anadido, colorFondo, colorLetra) 
            VALUES (:proveedor, :nombre, :primer_apellido, :segundo_apellido, :telefono, :cod_postal, :direccion, :articulo, :email, :nota, CURDATE(), :colorFondo, :colorLetra)";

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
        ':colorFondo' => $colorFondo, 
        ':colorLetra' => $colorLetra 
    ]);

    header('Location: index.php');
    exit();
}
?>
