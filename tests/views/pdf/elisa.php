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
require_once '../../controllers/ElisaController.php';

$elisa = $elisa_controller->show($_GET['item_id']);
$item = $item_controller->show($elisa['fk_item_id']);
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
    if (!empty($elisa['fecha'])) {
        echo "<div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>FECHA DE OBTENCIÓN DE MUESTRA</b><br>" . (new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE))->format(new DateTime($elisa['fecha']))  . "</span>";
        echo "</div>";
        echo "<hr>";
    }
    if (isset($elisa['observaciones'])) {
        echo "<div class='w3-panel w3-leftbar w3-tiny'>";
        echo "<span><b>OBSERVACIONES</b><br>" . nl2br(htmlspecialchars($elisa['observaciones'])) . "</span><br>";
        echo "</div>";
    }
    echo "<div class='w3-panel w3-leftbar w3-tiny'>";
    echo "<span><b>INTERPRETACIÓN</b><br>";
    if (isset($elisa['ac_anaplasma'])) {
        echo "Ac ANAPLASMA : " . $elisa['ac_anaplasma'] .  "<br>";
    }
    if (isset($elisa['ac_borrelia_burgdorferi'])) {
        echo "Ac BORRELIA BURGDORFERI : " . $elisa['ac_borrelia_burgdorferi'] . "<br>";
    }
    if (isset($elisa['ac_ehrlichia_canis'])) {
        echo "Ac EHRLICHIA CANIS : " . $elisa['ac_ehrlichia_canis'] . "<br>";
    }
    if (isset($elisa['ac_vif'])) {
        echo "Ac VIF : " . $elisa['ac_vif'] . "<br>";
    }
    if (isset($elisa['ag_dirofilaria_immitis'])) {
        echo "Ag DIROFILARIA IMMITIS : " . $elisa['ag_dirofilaria_immitis'] . "<br>";
    }
    if (isset($elisa['ag_filaria'])) {
        echo "Ag FILARIA : " . $elisa['ag_filaria'] . "<br>";
    }
    if (isset($elisa['ag_distemper_canino'])) {
        echo "Ag DISTEMPER CANINO : " . $elisa['ag_distemper_canino']  . "<br>";
    }
    if (isset($elisa['ag_levf'])) {
        echo "Ag LeVF : " . $elisa['ag_levf']  . "<br>";
    }
    if (isset($elisa['ag_parvovirus'])) {
        echo "Ag PARVOVIRUS : " . $elisa['ag_parvovirus'];
    }
    echo "</span>";
    echo "</div>";
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