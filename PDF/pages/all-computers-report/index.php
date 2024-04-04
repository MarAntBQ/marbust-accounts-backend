<?php
require_once  'controllers/pdf/autoload.php';
require_once "content/template.php";
$css = file_get_contents("pages/common-styles/styles.css");

$defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
	'fontDir' => array_merge($fontDirs, ['pages/common-styles/fonts',
    ]),
    'fontdata' => $fontData + [
        'nexa' => [
            'R' => 'Nexa-Light.ttf',
           
        ]
    ],
    'default_font' => 'nexa',
	'margin' => '10'
]);

//$mpdf = new \Mpdf\Mpdf();
$template = getTemplate();

// Then set the headers for the next page before you add the page
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($template, \Mpdf\HTMLParserMode::HTML_BODY);

//View
$mpdf->Output("Todas las Computadoras.pdf", "I");
//Dowload
//$mpdf->Output("Todos los Usuarios del Sistema.pdf", "D");
?>