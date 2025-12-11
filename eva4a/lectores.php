<?php
require_once('./includes/header.php');
require_once('./config/Conexion.php');
require_once('./model/Persona.php');
require_once('./model/Lector.php');

$conexion = Conexion::conexion();

?>
        <h2 class="mb-4">Listado de Lectores con Cantidad de Préstamos Realizados</h2>

        <table class="table table-striped table-hover">
                <thead>
                        <tr>
                                <th col="col-3">Nombre</th>
                                <th col="col-3">Correo</th>
                                <th col="col-3">DNI</th>
                                <th col="col-3"># Préstamos Total</th>
                        </tr>
                </thead>
                <tbody>
                        <?php
                        foreach($lectores as $prestamos){
                                echo '<tr>';
                                echo '<td>' . $prestamos->Getnombre() . '</td>';
                                echo '<td>' . $prestamos->Getcorreo() . '</td>';
                                echo '<td>' . $prestamos->getDni() . '</td>';
                        }
                        ?>
                </tbody>
        </table>
<?php
require_once('./includes/footer.php');
?>
