<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cursos (MVC)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5 bg-light">
    <div class="container">
        <h1 class="mb-4">Catalogo de Cursos MVC</h1>
        
        <div class="row">
            <?php foreach ($cursos as $curso): ?>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4><?php echo htmlspecialchars($curso['titulo']); ?></h4>
                            <p><?php echo htmlspecialchars($curso['descripcion']); ?></p>
                            <strong class="text-success">Precio: $<?php echo $curso['precio']; ?></strong>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>