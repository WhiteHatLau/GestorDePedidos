<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Consulta para eliminar el usuario por ID
    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    try {
        // Ejecuta la consulta con el ID pasado como parámetro
        $stmt->execute([':id' => $id]);

        // Redirigir a la página principal después de eliminar
        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        echo "Error al eliminar el usuario: " . $e->getMessage();
    }
} else {
    echo "ID de usuario no especificado o inválido.";
}
?>
