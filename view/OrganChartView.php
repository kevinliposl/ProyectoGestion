<?php
include_once '../business/UniversityBusiness.php';
include_once '../business/HeadquarterBusiness.php';
include_once '../business/EnclosureBusiness.php';
include_once '../business/CareerBusiness.php';

include_once '../util/PHPtoOrgChart.php';
include_once '../public/header.php';

$careerBusiness = new CareerBusiness;
$universityBusiness = new UniversityBusiness;
$headquarterBusiness = new HeadquarterBusiness;
$enclosureBusiness = new EnclosureBusiness;

$universities = $universityBusiness->selectAll();
$headquarters = $headquarterBusiness->selectAll();
$enclosures = $enclosureBusiness->selectAll();
$careers = $careerBusiness->selectAllByUniversity();

//foreach ($universities as $university) {
//    if ($university['universityhadheadquarter'] === 1) {
//        foreach ($headquarters as $headquarter) {
//            if ($university['universityid'] == $headquarter['headquarteruniversityid']) {
//            }
//        }
//    } else {
//        foreach ($enclosures as $enclosure) {
//            if ($university['universityid'] == $enclosure['enclosureuniversityid']) {
//                array_push($university, $enclosure);
//                foreach ($careers as $career) {
//                    if ($enclosure['enclosureid'] == $career['careerenclosureid']) {
//                        array_push($enclosure, $career);
//                    }
//                }
//            }
//        }
//    }
//}

$data = array(
//    $universities,
//    $enclosures,
//    $headquarters,
//    $careers,
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

