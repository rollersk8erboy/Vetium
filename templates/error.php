<!DOCTYPE html>
<html lang="es">

<?php
require_once $_SERVER['DOCUMENT_ROOT']  . '/templates/head.php';
?>

<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT']  . '/templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-danger">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0"><i class='fas fa-exclamation-triangle'></i></h4>
                    </div>
                    <div class="card-body">
                        <h4 class="alert-heading">¡Advertencia!</h4>
                        <p><?php echo $alert ?></p>
                        <hr>
                        <p><strong><?php echo isset($STATEMENT->errno) ? 'Código de error: ' . $STATEMENT->errno : '' ?></strong></p>
                    </div>
                    <button type="button" onclick="history.back()" class="btn card-footer">
                        <strong>Cerrar</strong>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>