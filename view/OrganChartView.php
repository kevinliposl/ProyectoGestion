

<?php
include_once '../business/UniversityBusiness.php';
include_once '../business/CareerBusiness.php';
include_once '../util/PHPtoOrgChart.php';
include_once '../public/header.php';
$careerBusiness = new CareerBusiness;

$data = array(
    'UNA' => array(
        'San Ramon' => array(
            'Economia' => 'Economia',
            'Ingenieria' => 'Ingenieria',
        ),
        'Liberia' => array(
            'Informatica' => 'Informatica',
            'Filosofia' => 'Filosofia'
        ),
    ),
);
?>

<link type="text/css" rel="stylesheet" href="../public/css/style.css"/>

<?php
echo '<div class = "orgchart ">';
PHPtoOrgChart($data);
echo '</div> ';

include_once '../public/footer.php';

