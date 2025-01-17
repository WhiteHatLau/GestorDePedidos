<?php
include 'config.php';

// Obtener el término de búsqueda
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

// Modificar la consulta SQL para permitir búsqueda en todos los campos, incluyendo el campo "nota"
$sql = "SELECT * FROM usuarios WHERE proveedor LIKE :buscar OR nombre LIKE :buscar OR primer_apellido LIKE :buscar OR segundo_apellido LIKE :buscar OR telefono LIKE :buscar OR cod_postal LIKE :buscar OR direccion LIKE :buscar OR articulo LIKE :buscar OR email LIKE :buscar OR nota LIKE :buscar";

$stmt = $pdo->prepare($sql);
$stmt->execute(['buscar' => '%' . $buscar . '%']);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ordenar resultados
$orden = isset($_GET['orden']) ? $_GET['orden'] : 'nombre';
$direccion = isset($_GET['direccion']) ? $_GET['direccion'] : 'ASC';

$sql .= " ORDER BY $orden $direccion";
$stmt = $pdo->prepare($sql);
$stmt->execute(['buscar' => '%' . $buscar . '%']);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="styles.css"> 
    <!-- Estilos del modal -->
<style>
    .modal {
        display: none; 
        position: fixed; 
        z-index: 1; 
        padding-top: 100px; 
        left: 0;
        top: 0;
        width: 100%; 
        height: 100%; 
        overflow: auto; 
        background-color: rgba(0,0,0,0.4); 
    }

    .modal-content {
        background-color: white;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover, .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
</head>
<body>
    <header>
        <h1>Gestión de Usuarios</h1>
    </header>

    <div class="container">
        <div id="formulario">
            <h2>Añadir Usuario</h2>
            <form action="agregar_usuario.php" method="POST">
                <input type="text" name="proveedor" placeholder="Proveedor" required>
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="primer_apellido" placeholder="Primer Apellido" required>
                <input type="text" name="segundo_apellido" placeholder="Segundo Apellido">
                <input type="text" name="telefono" placeholder="Teléfono" required>
                <input type="number" name="cod_postal" placeholder="Código Postal" required>
                <input type="text" name="direccion" placeholder="Dirección" required>
                <input type="text" name="articulo" placeholder="Artículo" required>                
                <input type="email" name="email" placeholder="Email" required>
                <textarea name="nota" placeholder="Notas"></textarea> 
                <label for="colorFondo"> Color de fondo: </label> <br/>
                <input type="color" name="colorFondo" value="#ffffff"><br/>
                <label for="colorLetra"> Color de letra: </label><br/>
                <input type="color" name="colorLetra" value="#000000"><br/>
                <input type="submit" value="Añadir Usuario" class="btn">
            </form>
        </div>

        <form method="GET" action="">
            <input type="text" id="buscar" name="buscar" placeholder="Buscar por nombre, teléfono, etc..." value="<?= htmlspecialchars($buscar) ?>" onkeyup="buscar()">
            <input type="submit" value="Buscar" class="btn">
        </form>

        <div class="table-responsive">
    <table id="tablaUsuarios">
        <thead>
            <tr>
                <th>Proveedor <a href="?orden=nombre&direccion=ASC">&#9650;</a> <a href="?orden=nombre&direccion=DESC">&#9660;</a></th>
                <th>Nombre <a href="?orden=nombre&direccion=ASC">&#9650;</a> <a href="?orden=nombre&direccion=DESC">&#9660;</a></th>
                <th>Artículo <a href="?orden=nombre&direccion=ASC">&#9650;</a> <a href="?orden=nombre&direccion=DESC">&#9660;</a></th>
                <th>Info <a href="?orden=nota&direccion=ASC">&#9650;</a> <a href="?orden=nota&direccion=DESC">&#9660;</a></th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
            <tr>
            <!-- Proveedor -->
            <td style="background-color: <?= htmlspecialchars($usuario['colorFondo']) ?>; color: <?= htmlspecialchars($usuario['colorLetra']) ?>;">
                <?= htmlspecialchars($usuario['proveedor']) ?>
            </td>

            <!-- Nombre -->
            <td style="background-color: <?= htmlspecialchars($usuario['colorFondo']) ?>; color: <?= htmlspecialchars($usuario['colorLetra']) ?>;">
                <?= htmlspecialchars($usuario['nombre']) ?>
            </td>
                <td><?= htmlspecialchars($usuario['articulo']) ?></td>
                <td>
    <a class="info-link" 
       data-proveedor="<?= htmlspecialchars($usuario['proveedor']) ?>"
       data-nombre="<?= htmlspecialchars($usuario['nombre']) ?>"
       data-primer-apellido="<?= htmlspecialchars($usuario['primer_apellido']) ?>"
       data-segundo-apellido="<?= htmlspecialchars($usuario['segundo_apellido']) ?>"
       data-telefono="<?= htmlspecialchars($usuario['telefono']) ?>"
       data-cod-postal="<?= htmlspecialchars($usuario['cod_postal']) ?>"
       data-direccion="<?= htmlspecialchars($usuario['direccion']) ?>"
       data-articulo="<?= htmlspecialchars($usuario['articulo']) ?>"
       data-email="<?= htmlspecialchars($usuario['email']) ?>"
       data-nota="<?= htmlspecialchars($usuario['nota']) ?>"
       onclick="mostrarNota(this); return false;">
        <span style="color: green;">Ver info</span>
    </a>
</td>

                <td><?= htmlspecialchars($usuario['fecha_anadido']) ?></td>
                <td>
                    <a href="editar_usuario.php?id=<?= $usuario['id'] ?>" class="btn">Editar</a>
                    <a href="eliminar_usuario.php?id=<?= $usuario['id']; ?>" class="btn eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="modalNota" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="cerrarNota()">&times;</span>
        <p id="contenidoNota"></p>
    </div>
</div>

<script>
    // Función para mostrar el modal con la nota
    function mostrarNota(element) {
    const proveedor = element.getAttribute('data-proveedor');
    const nombre = element.getAttribute('data-nombre');
    const primerApellido = element.getAttribute('data-primer-apellido');
    const segundoApellido = element.getAttribute('data-segundo-apellido');
    const telefono = element.getAttribute('data-telefono');
    const codPostal = element.getAttribute('data-cod-postal');
    const direccion = element.getAttribute('data-direccion');
    const articulo = element.getAttribute('data-articulo');
    const email = element.getAttribute('data-email');
    const nota = element.getAttribute('data-nota');

    // Crear un mensaje para mostrar en el modal
    const contenido = `
        Proveedor: ${proveedor}<br>
        Nombre: ${nombre}<br>
        Primer Apellido: ${primerApellido}<br>
        Segundo Apellido: ${segundoApellido}<br>
        Teléfono: ${telefono}<br>
        Código Postal: ${codPostal}<br>
        Dirección: ${direccion}<br>
        Artículo: ${articulo}<br>
        Email: ${email}<br>
        Nota: ${nota}
    `;

    document.getElementById('contenidoNota').innerHTML = contenido; // Usar innerHTML para permitir etiquetas HTML
    document.getElementById('modalNota').style.display = 'block';
}

    // Función para cerrar el modal
    function cerrarNota() {
        document.getElementById('modalNota').style.display = 'none';
    }

    // Cerrar el modal si el usuario hace clic fuera del contenido
    window.onclick = function(event) {
        var modal = document.getElementById('modalNota');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }
</script>




    <script src="scripts.js"></script> 
</body>
</html>
