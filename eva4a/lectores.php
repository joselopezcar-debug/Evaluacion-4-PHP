<?php
require_once('./model/Usuario.php');
require_once('./includes/header.php');

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->getIdRol() != 1) {
    header('Location: index.php');
    exit();
}

require_once('./model/Lector.php');
?>
        <h2 class="mb-4">Listado de Lectores con Cantidad de Préstamos Realizados</h2>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Correo</th>
                    <th>Préstamos Realizados</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $lectores = Lector::listarConConteoPrestamos();
                
                foreach ($lectores as $lector):
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($lector->getId()); ?></td>
                    <td><?php echo htmlspecialchars($lector->getNombre()); ?></td>
                    <td><?php echo htmlspecialchars($lector->getDni()); ?></td>
                    <td><?php echo htmlspecialchars($lector->getCorreo()); ?></td>
                    <td><?php echo htmlspecialchars($lector->cantidad_prestamos); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
<?php
require_once('./includes/footer.php');
?>
