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
require_once '../../controllers/CoproparasitoscopicoController.php';

$coproparasitoscopico = $coproparasitoscopico_controller->show($_GET['item_id']);
$item = $item_controller->show($coproparasitoscopico['fk_item_id']);
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
    if (isset($coproparasitoscopico['prueba'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<h6><b>PRUEBA</b><br>" . nl2br(htmlspecialchars($coproparasitoscopico['prueba'])) . "</h6>";
        echo "</div>";
    }
    if (isset($coproparasitoscopico['resultado_1'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>MUESTRA 1<br></b> Obtenida el " . (new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE))->format(new DateTime($coproparasitoscopico['fecha_1']))  . "<br>" . nl2br(htmlspecialchars($coproparasitoscopico['resultado_1'])) . "</span>";
        echo "</div>";
    }
    if (isset($coproparasitoscopico['resultado_2'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>MUESTRA 2<br></b> Obtenida el " . (new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE))->format(new DateTime($coproparasitoscopico['fecha_2']))  . "<br>" . nl2br(htmlspecialchars($coproparasitoscopico['resultado_2'])) . "</span>";
        echo "</div>";
    }
    if (isset($coproparasitoscopico['resultado_3'])) {
        echo " <div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>MUESTRA 3<br></b> Obtenida el " . (new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE))->format(new DateTime($coproparasitoscopico['fecha_3']))  . "<br>" . nl2br(htmlspecialchars($coproparasitoscopico['resultado_3'])) . "</span>";
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