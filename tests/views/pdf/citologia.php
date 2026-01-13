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
require_once '../../controllers/CitologiaController.php';

$citologia = $citologia_controller->show($_GET['item_id']);
$item = $item_controller->show($citologia['fk_item_id']);
$study = $study_controller->show($item['fk_study_id']);
$case = $case_controller->show($item['fk_case_id']);
$clinic = $clinic_controller->show($case['fk_clinic_id']);
$breed = $breed_controller->show($case['fk_breed_id']);
$specie = $specie_controller->show($breed['fk_specie_id']);

require_once '../../templates/head.php';
?>

<body>
    <?php
    require_once '../../templates/banner.php';

    if (!empty($citologia['fecha'])) {
        echo "<div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>FECHA DE OBTENCIÓN DE MUESTRA</b><br>" . (new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE))->format(new DateTime($citologia['fecha']))  . "</span>";
        echo "</div>";
        echo "<hr>";
    }

    if (isset($citologia['descripcion_macroscopica_de_la_lesion'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny' align='justify'>";
        echo "<span><b>DESCRIPCIÓN MACROSCÓPICA DE LA LESIÓN</b><br> " . nl2br(htmlspecialchars($citologia['descripcion_macroscopica_de_la_lesion'])) . "</span><br>";
        echo "</div>";
    }
    if (isset($citologia['descripcion_citologica'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny' align='justify'>";
        echo "<span><b>DESCRIPCIÓN CITOLÓGICA</b><br> " . nl2br(htmlspecialchars($citologia['descripcion_citologica'])) . "</span><br>";
        echo "</div>";
    }
    if (isset($citologia['interpretaciones'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny'  align='justify'>";
        echo "<span><b>INTERPRETACIÓN</b><br> " . nl2br(htmlspecialchars($citologia['interpretaciones'])) . "</span><br>";
        echo "</div>";
    }
    if (isset($citologia['diagnostico'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny' align='justify'>";
        echo "<span><b>DIAGNÓSTICO</b><br> " . nl2br(htmlspecialchars($citologia['diagnostico'])) . "</span><br>";
        echo "</div>";
    }
    if (isset($citologia['comentario'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny' align='justify'>";
        echo "<span><b>COMENTARIO</b><br> " . nl2br(htmlspecialchars($citologia['comentario']))  . "</span><br>";
        echo "</div>";
    }
    require_once '../../templates/footer.php';
    ?>
    <div style="page-break-after: always;"></div>
    <div style="height: 100vh;"></div>
</body>

</html>

<?php
$dompdf->loadHtml(ob_get_clean());
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($case['case_number'] . ' - ' . $study['study'], array('Attachment' => 0));
?>