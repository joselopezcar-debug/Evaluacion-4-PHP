<?php
require_once('./includes/header.php');
require_once('./config/Conexion.php');
require_once('./model/Libro.php');

$conexion = Conexion::conexion();

?>
<h2 class="mb-4">Consulta de Préstamos Activos</h2>
        
        <div class="card p-4 mb-4">
            <form action="libros.php" method="POST">
                <div class="row g-3 align-items-end">
                    <div class="col-md-8">
                        <label for="id_libro" class="form-label">Seleccione un Libro:</label>
                        <select id="id_libro" name="id_libro" class="form-select" required>
                            <option value="">-- Seleccione --</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">Ver Préstamo Activo</button>
                    </div>
                </div>
            </form>
        </div>

        <h3 class="mt-5">Estado del Libro: <span class="text-danger"></span></h3>
        <div class="card border-danger mb-3">
            <div class="card-header bg-danger text-white">
                Libro **PRESTADO**
            </div>
            <div class="card-body">
            </div>
        </div>
<?php
require_once('./includes/footer.php');
?>
