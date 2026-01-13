<!DOCTYPE html>
<html lang="es">

<?php
setlocale(LC_TIME, 'es_ES');
require_once '../../templates/head.php';
require_once '../../controllers/DatabaseController.php';
require_once '../../controllers/CaseController.php';
require_once '../../controllers/ClinicController.php';
require_once '../../controllers/BreedController.php';
require_once '../../controllers/SpecieController.php';
require_once '../../controllers/ItemController.php';
require_once '../../controllers/PaymentController.php';

$case = $case_controller->show($_GET['case_id']);
$clinic = $clinic_controller->show($case['fk_clinic_id']);
$breed =  $breed_controller->show($case['fk_breed_id']);
$specie = $specie_controller->show($breed['fk_specie_id']);
$items = $item_controller->index($case['case_id']);
$payments = $payment_controller->index($case['case_id']);
$item_controller->store($case['case_id'], $clinic['clinic_id']);
$payment_controller->store($case['case_id']);
?>

<body>
    <?php require_once '../../templates/navigation.php'; ?>
    <div class="content">
        <div class="overlay" onclick="toggleSidebar()"></div>
        <div class="card bg-dark text-white p-5 mb-4">
            <h1><?php echo $case['case_number'] ?></h1>
        </div>
        <div class="row">
            <div class="col mb-4">
                <div class="card bg-light h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Mascota<nav></nav>
                        </h5>
                        <p class="card-text"><i class='fas fa-clinic-medical fa-fw'></i> Clínica: <?php echo $clinic['clinic'] ?></p>
                        <p class="card-text"><i class='fas fa-horse-head fa-fw'></i> Mascota: <?php echo $case['pet'] ?></p>
                        <p class="card-text"><i class='fas fa-cat fa-fw'></i> Especie: <?php echo $specie['specie']  ?></p>
                        <p class="card-text"><i class='fas fa-paw fa-fw'></i> Raza: <?php echo $breed['breed']  ?></p>
                        <p class="card-text"><i class='fas fa-venus-mars fa-fw'></i> Sexo: <?php echo $case['sex'] ?></p>
                        <p class="card-text"><i class='fas fa-paw fa-fw'></i> Edad: <?php echo $case['age'] ?></p>
                        <p class="card-text"><i class='fas fa-clock fa-fw'></i> Condición corporal: <?php echo $case['body_condition_score'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card bg-light h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Caso<nav></nav>
                        </h5>
                        <?php
                        if (!empty($case['anamnesis'])) {
                            echo "<p class='card-text'><i class='fas fa-notes-medical fa-fw'></i> Anamnesis: </p>";
                            echo "<p class='card-text' style='text-align: justify;'><i>{$case['anamnesis']}</i></p>";
                        }
                        if (!empty($case['treatment'])) {
                            echo "<p class='card-text'><i class='fas fa-capsules fa-fw'></i> Tratamiento: </p>";
                            echo "<p class='card-text' style='text-align: justify;'><i>{$case['treatment']}</i></p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card bg-light h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Pago<nav></nav>
                        </h5>
                        <p class="card-text"><i class='fas fa-dollar-sign fa-fw'></i> Precio: <?php echo $case['price_type'] ?></p>
                        <p class="card-text"><i class='fas fa-file-invoice fa-fw'></i> Factura: <?php echo $case['invoice'] ?></p>
                        <p class="card-text"><i class='fas fa-donate fa-fw'></i> Deuda: <?php echo $case['debt'] ?></p>
                        <p class="card-text"><i class='fas fa-exclamation-circle fa-fw'></i> Estado de pago: <?php echo $case['payment_status'] ?></p>
                        <p class="card-text"><i class='fas fa-paper-plane fa-fw'></i> Estado de entrega: <?php echo $case['delivery_status'] ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-light mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Estudio solicitado</th>
                                <th>Precio</th>
                                <th>Fecha de solicitud</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($items)) {
                                while ($item = $items->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td> {$item['study']} </td>";
                                    echo "<td> {$item['price']} </td>";
                                    echo "<td>" . (new IntlDateFormatter('es-ES', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'America/Merida', IntlDateFormatter::GREGORIAN, "d 'de' LLLL 'de' yyyy  (h:mm a)"))->format(new DateTime($item['item_date'])) . "</td>";
                                    if ($item['form'] === 'NO') {
                                        echo
                                        "<td class='col-2'>
                                            <div class='btn-group d-flex'>
                                                <a class='btn btn-danger' href='/views/items/destroy.php?item_id={$item['item_id']}&case_id={$case['case_id']}' onclick='return confirm(\"¿Está seguro de que desea eliminar este registro de forma permanente?\");'>Eliminar</a>
                                            </div>
                                        </td>";
                                    } else {
                                        echo
                                        "<td class='col-2'>
                                            <div class='btn-group d-flex'>
                                                <a class='btn btn-warning' href='/tests/index.php?item_id={$item['item_id']}&study_id={$item['study_id']}'>Editar</a>
                                                <a class='btn btn-danger' href='/views/items/destroy.php?item_id={$item['item_id']}&case_id={$case['case_id']}' onclick='return confirm(\"¿Está seguro de que desea eliminar este registro de forma permanente?\");'>Eliminar</a>
                                            </div>
                                        </td>";
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm text-end">
                            <tbody>
                                <tr>
                                    <td>Subtotal:</td>
                                    <td><?php echo $case['subtotal'] ?></td>
                                </tr>
                                <tr>
                                    <td>IVA (16%):</td>
                                    <td><?php echo $case['iva'] ?></td>
                                </tr>
                                <tr>
                                    <td>Total (IVA incluido, en caso de ser aplicable):</td>
                                    <td><?php echo $case['total'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <form method="post" autocomplete="off">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <select class="form-control" data-live-search="true" name="fk_study_id" required>
                            <?php require_once '../../views/studies/options.php'; ?>
                        </select>
                        <button type="submit" class="btn btn-success text-nowrap">Agregar estudio</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card bg-light">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Abono</th>
                                <th>Método de pago</th>
                                <th>Realizado</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($payment = $payments->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td> {$payment['payment']} </td>";
                                echo "<td> {$payment['payment_type']} </td>";
                                echo "<td>" . (new IntlDateFormatter('es-ES', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'America/Merida', IntlDateFormatter::GREGORIAN, "d 'de' LLLL 'de' yyyy  (h:mm a)"))->format(new DateTime($payment['payment_date'])) . "</td>";
                                echo
                                "<td class='col-2'>
                                        <div class='btn-group d-flex'>
                                            <a class='btn btn-danger' href='/views/payments/destroy.php?payment_id={$payment['payment_id']}&case_id={$case['case_id']}' onclick='return confirm(\"¿Está seguro de que desea eliminar este registro de forma permanente?\");'>Eliminar</a>
                                        </div>
                                </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <form method="post" autocomplete="off">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <input type="number" step=".01" class="form-control" placeholder="0.00" name="payment" required>
                        <select class="form-control" name="payment_type" required>
                            <option value="" disabled selected>SELECCIONA UNA OPCIÓN</option>
                            <option value="EFECTIVO">EFECTIVO</option>
                            <option value="TERMINAL BANCARIA">TERMINAL BANCARIA</option>
                            <option value="TRANSFERENCIA ELECTRÓNICA">TRANSFERENCIA ELECTRÓNICA</option>
                        </select>
                        <button type="submit" class="btn btn-success text-nowrap">Agregar abono</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>

</html>