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
require_once '../../controllers/TiemposController.php';

$tiempos = $tiempos_controller->show($_GET['item_id']);
$item = $item_controller->show($tiempos['fk_item_id']);
$study = $study_controller->show($item['fk_study_id']);
$case = $case_controller->show($item['fk_case_id']);
$clinic = $clinic_controller->show($case['fk_clinic_id']);
$breed = $breed_controller->show($case['fk_breed_id']);
$specie = $specie_controller->show($breed['fk_specie_id']);
$referencias = $referencia_controller->show($tiempos['fk_referencia_id']);

if (isset($referencias)) {
    $tiempos['tiempo_de_tromboplastina'] = $referencia_controller->round($tiempos['tiempo_de_tromboplastina'], $referencias['tiempo_de_tromboplastina']);
    $tiempos['tiempo_de_protrombina'] = $referencia_controller->round($tiempos['tiempo_de_protrombina'], $referencias['tiempo_de_protrombina']);
}


require_once '../../templates/head.php';
?>

<body>
    <?php require_once '../../templates/banner.php';

    if (!empty($tiempos['fecha'])) {
        echo "<div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>FECHA DE OBTENCIÓN DE MUESTRA</b><br>" . (new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE))->format(new DateTime($tiempos['fecha']))  . "</span>";
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
        if (isset($tiempos['tiempo_de_tromboplastina']) && isset($referencias['tiempo_de_tromboplastina'])) {
            echo "<tr>";
            echo "<td>TIEMPO DE TROMBOPLASTINA</td>";
            echo "<td class='w3-right-align'>{$tiempos['tiempo_de_tromboplastina']}</td>";
            echo "<td class='w3-right-align'>s</td>";
            echo "<td class='w3-right-align'>{$referencias['tiempo_de_tromboplastina']}</td>";
            echo  "</tr>";
        }
        if (isset($tiempos['tiempo_de_protrombina']) && isset($referencias['tiempo_de_protrombina'])) {
            echo "<tr>";
            echo "<td>TIEMPO DE PROTOMBINA</td>";
            echo "<td class='w3-right-align'>{$tiempos['tiempo_de_protrombina']}</td>";
            echo "<td class='w3-right-align'>s</td>";
            echo "<td class='w3-right-align'>{$referencias['tiempo_de_protrombina']}</td>";
            echo  "</tr>";
        }
        ?>
    </table>
    <hr>
    <?php
    if (isset($tiempos['interpretaciones'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>INTERPRETACIÓN</b><br>"  . nl2br(htmlspecialchars($tiempos['interpretaciones'])) .  "</span><br>";
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