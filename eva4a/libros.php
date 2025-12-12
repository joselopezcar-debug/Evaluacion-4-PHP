<?php
require_once('./model/Usuario.php');
require_once('./includes/header.php');
require_once('./model/Libro.php');

$libros = Libro::listarTodos();
$lectorActivo = null;
$libroSeleccionado = null;
$libroTitulo = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_libro'])) {
    $idLibroSeleccionado = $_POST['id_libro'];
    
    // Buscar el título del libro seleccionado
    foreach ($libros as $libro) {
        if ($libro->getId() == $idLibroSeleccionado) {
            $libroSeleccionado = $libro;
            $libroTitulo = $libro->getTitulo();
            break;
        }
    }
    
    if ($libroSeleccionado) {
        $libroObj = new Libro();
        $lectorActivo = $libroObj->obtenerLectorActivo($idLibroSeleccionado);
    }
}
?>
<h2 class="mb-4">Consulta de Préstamos Activos</h2>
        
<div class="card p-4 mb-4">
    <form action="libros.php" method="POST">
        <div class="row g-3 align-items-end">
            <div class="col-md-8">
                <label for="id_libro" class="form-label">Seleccione un Libro:</label>
                <select id="id_libro" name="id_libro" class="form-select" required>
                    <option value="">-- Seleccione --</option>
                    <?php foreach ($libros as $libro): ?>
                    <option value="<?php echo $libro->getId(); ?>" 
                        <?php echo (isset($_POST['id_libro']) && $_POST['id_libro'] == $libro->getId()) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($libro->getTitulo()); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Ver Préstamo Activo</button>
            </div>
        </div>
    </form>
</div>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
<h3 class="mt-5">Estado del Libro: <span class="text-danger"><?php echo htmlspecialchars($libroTitulo); ?></span></h3>

<?php if ($lectorActivo): ?>
<div class="card border-danger mb-3">
    <div class="card-header bg-danger text-white">
        Libro <strong>PRESTADO</strong>
    </div>
    <div class="card-body">
        <h5 class="card-title">Información del Préstamo:</h5>
        <p><strong>Lector:</strong> <?php echo htmlspecialchars($lectorActivo['lector_nombre']); ?></p>
        <p><strong>DNI:</strong> <?php echo htmlspecialchars($lectorActivo['lector_dni']); ?></p>
        <p><strong>Fecha de Préstamo:</strong> <?php echo date('d/m/Y', strtotime($lectorActivo['fecha_prestamo'])); ?></p>
        <p><strong>Días prestado:</strong> 
            <?php 
                $fechaPrestamo = new DateTime($lectorActivo['fecha_prestamo']);
                $hoy = new DateTime();
                echo $hoy->diff($fechaPrestamo)->format('%a'); 
            ?> días
        </p>
    </div>
</div>
<?php else: ?>
<div class="card border-success mb-3">
    <div class="card-header bg-success text-white">
        Libro <strong>DISPONIBLE</strong>
    </div>
    <div class="card-body">
        <p class="card-text">El libro se encuentra disponible para préstamo.</p>
    </div>
</div>
<?php endif; ?>

<?php endif; ?>

<?php
require_once('./includes/footer.php');
?>
