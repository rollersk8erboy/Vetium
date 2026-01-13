<?php
require_once '../../../autoload.inc.php';

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
require_once '../../controllers/KController.php';

$k = $k_controller->show($_GET['item_id']);
$item = $item_controller->show($k['fk_item_id']);
$study = $study_controller->show($item['fk_study_id']);
$case = $case_controller->show($item['fk_case_id']);
$clinic = $clinic_controller->show($case['fk_clinic_id']);
$breed = $breed_controller->show($case['fk_breed_id']);
$specie = $specie_controller->show($breed['fk_specie_id']);
$referencias = $referencia_controller->show($k['fk_referencia_id']);

if (isset($referencias)) {
    $k['colesterol'] = $referencia_controller->round($k['colesterol'], $referencias['colesterol']);
    $k['t4_libre'] = $referencia_controller->round($k['t4_libre'], $referencias['t4_libre']);
}


require_once '../../templates/head.php';
?>

<body>
    <?php require_once '../../templates/banner.php';
    if (!empty($k['fecha'])) {
        echo "<div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>FECHA DE OBTENCIÓN DE MUESTRA</b><br>" . (new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE))->format(new DateTime($k['fecha']))  . "</span>";
        echo "</div>";
        echo "<hr>";
    }
    ?>
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
        if (isset($k['colesterol']) && isset($referencias['colesterol'])) {
            echo "<tr>";
            echo "<td>COLESTEROL</td>";
            echo "<td class='w3-right-align'>{$k['colesterol']}</td>";
            echo "<td class='w3-right-align'>mmol/L</td>";
            echo "<td class='w3-right-align'>{$referencias['colesterol']}</td>";
            echo  "</tr>";
        }
        if (isset($k['t4_libre']) && isset($referencias['t4_libre'])) {
            echo "<tr>";
            echo "<td>T4 LIBRE</td>";
            echo "<td class='w3-right-align'>{$k['t4_libre']}</td>";
            echo "<td class='w3-right-align'>pmol/L</td>";
            echo "<td class='w3-right-align'>{$referencias['t4_libre']}</td>";
            echo  "</tr>";
        }
        ?>
    </table>
    <?php
    if (isset($k['k']) || isset($k['diagnostico']) || isset($k['valores_de_referencia'])) {
        echo "<hr>";
        if (isset($k['k'])) {
            echo "<div class='w3-panel w3-leftbar w3-tiny'>";
            echo "<span><b>VALOR DE K</b><br>" . nl2br(htmlspecialchars($k['k'])) . "</span>";
            echo "</div>";
        }
        if (isset($k['diagnostico'])) {
            echo "<div class='w3-panel w3-leftbar w3-tiny'>";
            echo "<span><b>DIAGNÓSTICO</b><br>" . nl2br(htmlspecialchars($k['diagnostico'])) . "</span>";
            echo "</div>";
        }
        if (isset($k['valores_de_referencia'])) {
            echo "<div class='w3-panel w3-leftbar w3-tiny'>";
            echo "<span><b>VALORES DE REFERENCIA</b><br>" . nl2br(htmlspecialchars($k['valores_de_referencia'])) . "</span>";
            echo "</div>";
        }
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