<?php
require_once '../../../dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('isCssFloatEnabled', true);
$options->set('isJavascriptEnabled', false);
$options->set('isHtml5ParserEnabled', true);
$dompdf = new Dompdf($options);

ob_start();
?>

<!DOCTYPE html>
<html>

<?php
require_once '../../../controllers/DatabaseController.php';
require_once '../../../controllers/ClinicController.php';
require_once '../../../controllers/BreedController.php';
require_once '../../../controllers/SpecieController.php';
require_once '../../../controllers/StudyController.php';
require_once '../../../controllers/CaseController.php';
require_once '../../../controllers/ItemController.php';
require_once '../../controllers/ReferenciaController.php';
require_once '../../controllers/PruebasController.php';

$pruebas = $pruebas_controller->show($_GET['item_id']);
$item = $item_controller->show($pruebas['fk_item_id']);
$study = $study_controller->show($item['fk_study_id']);
$case = $case_controller->show($item['fk_case_id']);
$clinic = $clinic_controller->show($case['fk_clinic_id']);
$breed = $breed_controller->show($case['fk_breed_id']);
$specie = $specie_controller->show($breed['fk_specie_id']);
$referencias = $referencia_controller->show($pruebas['fk_referencia_id']);

if (isset($referencias)) {
    $pruebas['hematocrito'] = $referencia_controller->round($pruebas['hematocrito'], $referencias['hematocrito']);
}


require_once '../../templates/head.php';
?>

<body>
    <?php require_once '../../templates/banner.php'; ?>
    <table class="w3-table w3-tiny">
        <thead>
            <tr>
                <th>ANALITO</th>
                <th class="w3-right-align">RESULTADO</th>
                <th class='w3-right-align'>UNIDAD</th>
                <th class="w3-right-align">VALORES DE REFERENCIA</th>
            </tr>
        </thead>
        <?php
        if (isset($pruebas['hematocrito']) && isset($referencias['hematocrito'])) {
            echo "<tr>";
            echo "<td>HEMATOCRITO</td>";
            echo "<td class='w3-right-align'>{$pruebas['hematocrito']}</td>";
            echo "<td class='w3-right-align'>L/L</td>";
            echo "<td class='w3-right-align'>" . htmlentities($referencias['hematocrito']) . "</td>";
            echo  "</tr>";
        }
        ?>
    </table>
    <hr>
    <?php
    if (isset($pruebas['donador_1'])) {
        echo '<table class="w3-table w3-tiny">';
        echo '<tr>';
        echo '<th>DONADOR 1</th>';
        echo '<th class="w3-right-align">ANALITO</th>';
        echo '<th class="w3-right-align"><strong>RESULTADO</strong></th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>' . $pruebas['donador_1'] . '</td>';
        echo '<td class="w3-right-align">HEMATOCRITO</td>';
        echo '<td class="w3-right-align">' . $pruebas['hematocrito_donador_1'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th><strong>EVALUACIÓN MACROSCÓPICA</strong></th>';
        echo '<th class="w3-right-align"><strong>APARIENCIA</strong></th>';
        echo '<th class="w3-right-align"><strong>AGREGADOS CELULARES</strong></th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MAYOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_mayor_apariencia_donador_1'] . '</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_mayor_agregados_celulares_donador_1'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MENOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_menor_apariencia_donador_1'] . '</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_menor_agregados_celulares_donador_1'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th><strong>EVALUACIÓN MICROSCÓPICA</strong></th>';
        echo '<th class="w3-right-align"><strong>AGLUTINACIÓN</strong></th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MAYOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_mayor_aglutinacion_donador_1'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MENOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_menor_aglutinacion_donador_1'] . '</td>';
        echo '</tr>';
        echo '</table>';
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>OBSERVACIONES</b><br>" . nl2br(htmlspecialchars($pruebas['observaciones_donador_1'])) . "</span><br>";
        echo "</div>";
    }
    if (isset($pruebas['donador_2'])) {
        echo "<br>";
        echo '<table class="w3-table w3-tiny">';
        echo '<tr>';
        echo '<th>DONADOR 2</th>';
        echo '<th class="w3-right-align">ANALITO</th>';
        echo '<th class="w3-right-align"><strong>RESULTADO</strong></th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>' . $pruebas['donador_2'] . '</td>';
        echo '<td class="w3-right-align">HEMATOCRITO</td>';
        echo '<td class="w3-right-align">' . $pruebas['hematocrito_donador_2'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th><strong>EVALUACIÓN MACROSCÓPICA</strong></th>';
        echo '<th class="w3-right-align"><strong>APARIENCIA</strong></th>';
        echo '<th class="w3-right-align"><strong>AGREGADOS CELULARES</strong></th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MAYOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_mayor_apariencia_donador_2'] . '</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_mayor_agregados_celulares_donador_2'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MENOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_menor_apariencia_donador_2'] . '</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_menor_agregados_celulares_donador_2'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th><strong>EVALUACIÓN MICROSCÓPICA</strong></th>';
        echo '<th class="w3-right-align"><strong>AGLUTINACIÓN</strong></th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MAYOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_mayor_aglutinacion_donador_2'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MENOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_menor_aglutinacion_donador_2'] . '</td>';
        echo '</tr>';
        echo '</table>';
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>OBSERVACIONES</b><br>" . nl2br(htmlspecialchars($pruebas['observaciones_donador_2'])) . "</span><br>";
        echo "</div>";
    }
    if (isset($pruebas['donador_3'])) {
        echo "<br>";
        echo '<table class="w3-table w3-tiny">';
        echo '<tr>';
        echo '<th>DONADOR 3</th>';
        echo '<th class="w3-right-align">ANALITO</th>';
        echo '<th class="w3-right-align"><strong>RESULTADO</strong></th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>' . $pruebas['donador_3'] . '</td>';
        echo '<td class="w3-right-align">HEMATOCRITO</td>';
        echo '<td class="w3-right-align">' . $pruebas['hematocrito_donador_3'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th><strong>EVALUACIÓN MACROSCÓPICA</strong></th>';
        echo '<th class="w3-right-align"><strong>APARIENCIA</strong></th>';
        echo '<th class="w3-right-align"><strong>AGREGADOS CELULARES</strong></th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MAYOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_mayor_apariencia_donador_3'] . '</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_mayor_agregados_celulares_donador_3'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MENOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_menor_apariencia_donador_3'] . '</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_menor_agregados_celulares_donador_3'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th><strong>EVALUACIÓN MICROSCÓPICA</strong></th>';
        echo '<th class="w3-right-align"><strong>AGLUTINACIÓN</strong></th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MAYOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_mayor_aglutinacion_donador_3'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MENOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_menor_aglutinacion_donador_3'] . '</td>';
        echo '</tr>';
        echo '</table>';
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>OBSERVACIONES</b><br>" . nl2br(htmlspecialchars($pruebas['observaciones_donador_3'])) . "</span><br>";
        echo "</div>";
        echo "<br>";
    }
    if (isset($pruebas['donador_4'])) {
        echo '<table class="w3-table w3-tiny">';
        echo '<tr>';
        echo '<th>DONADOR 4</th>';
        echo '<th class="w3-right-align">ANALITO</th>';
        echo '<th class="w3-right-align"><strong>RESULTADO</strong></th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>' . $pruebas['donador_4'] . '</td>';
        echo '<td class="w3-right-align">HEMATOCRITO</td>';
        echo '<td class="w3-right-align">' . $pruebas['hematocrito_donador_4'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th><strong>EVALUACIÓN MACROSCÓPICA</strong></th>';
        echo '<th class="w3-right-align"><strong>APARIENCIA</strong></th>';
        echo '<th class="w3-right-align"><strong>AGREGADOS CELULARES</strong></th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MAYOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_mayor_apariencia_donador_4'] . '</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_mayor_agregados_celulares_donador_4'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MENOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_menor_apariencia_donador_4'] . '</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_menor_agregados_celulares_donador_4'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th><strong>EVALUACIÓN MICROSCÓPICA</strong></th>';
        echo '<th class="w3-right-align"><strong>AGLUTINACIÓN</strong></th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MAYOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_mayor_aglutinacion_donador_4'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MENOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_menor_aglutinacion_donador_4'] . '</td>';
        echo '</tr>';
        echo '</table>';
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>OBSERVACIONES</b><br>" . nl2br(htmlspecialchars($pruebas['observaciones_donador_4'])) . "</span><br>";
        echo "</div>";
    }
    if (isset($pruebas['donador_5'])) {
        echo "<br>";
        echo '<table class="w3-table w3-tiny">';
        echo '<tr>';
        echo '<th>DONADOR 5</th>';
        echo '<th class="w3-right-align">ANALITO</th>';
        echo '<th class="w3-right-align"><strong>RESULTADO</strong></th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>' . $pruebas['donador_5'] . '</td>';
        echo '<td class="w3-right-align">HEMATOCRITO</td>';
        echo '<td class="w3-right-align">' . $pruebas['hematocrito_donador_5'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th><strong>EVALUACIÓN MACROSCÓPICA</strong></th>';
        echo '<th class="w3-right-align"><strong>APARIENCIA</strong></th>';
        echo '<th class="w3-right-align"><strong>AGREGADOS CELULARES</strong></th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MAYOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_mayor_apariencia_donador_5'] . '</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_mayor_agregados_celulares_donador_5'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MENOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_menor_apariencia_donador_5'] . '</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_menor_agregados_celulares_donador_5'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th><strong>EVALUACIÓN MICROSCÓPICA</strong></th>';
        echo '<th class="w3-right-align"><strong>AGLUTINACIÓN</strong></th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MAYOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_mayor_aglutinacion_donador_5'] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>PRUEBA MENOR</td>';
        echo '<td class="w3-right-align">' . $pruebas['prueba_menor_aglutinacion_donador_5'] . '</td>';
        echo '</tr>';
        echo '</table>';
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>OBSERVACIONES</b><br>" . nl2br(htmlspecialchars($pruebas['observaciones_donador_5'])) . "</span><br>";
        echo "</div>";
    }
    echo "<br>";
    echo "<hr>";
    if (isset($pruebas['interpretaciones'])) {
        echo "<div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>INTERPRETACIÓN</b><br>"  . nl2br(htmlspecialchars($pruebas['interpretaciones'])) .  "</span><br>";
        echo "</div>";
    }
    require_once '../../templates/footer.php';
    ?>
</body>

</html>

<?php
$dompdf->loadHtml(ob_get_clean());
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($case['case_number'] . ' - ' . $study['study'], array('Attachment' => 0));
?>