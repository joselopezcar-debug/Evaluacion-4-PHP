<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container" style="max-width:400px;margin-top:80px;">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title text-center">Iniciar Sesión</h3>
                <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
                <?php endif; ?>
                <form action="ingresar.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="email" name="correo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Clave</label>
                        <input type="password" name="clave" class="form-control" required>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Ingresar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>