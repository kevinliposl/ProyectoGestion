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
//                array_push($university, $headquarter['headquartername']);
//                foreach ($enclosures as $enclosure) {
//                    if ($enclosure['enclosureheadquarterid'] == $headquarter['headquarterid']) {
//                        array_push($headquarter, $enclosure['enclosurename']);
//                        foreach ($careers as $career) {
//                            if ($enclosure['enclosureid'] == $career['careerenclosureid']) {
//                                array_push($enclosure, $career['careername']);
//                            }
//                        }
//                    }
//                }
//            }
//        }
//    } else {
//        foreach ($enclosures as $enclosure) {
//            if ($university['universityid'] == $enclosure['enclosureuniversityid']) {
//                array_push($university, $enclosure['enclosurename']);
//                foreach ($careers as $career) {
//                    if ($enclosure['enclosureid'] == $career['careerenclosureid']) {
//                        array_push($enclosure, $career['careername']);
//                    }
//                }
//            }
//        }
//    }
//}

$data = array(
    //$universities,
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
    'UCR' => array(
        'Sede del Atlantico' => array(
            'Turrialba' => array(
                'Informatica Emplesarial' => 'Informatica Emplesarial',
                'Contaduria Publica' => 'Contaduria Publica',
            ),
            'Paraiso' => array(
                'Direccion de empresas' => 'Direccion de empresas',
                'Enseñanza de las mantematicas' => 'Enseñanza de las mantematicas'
            ),
        ),
        'Sede del Occidente' => array(
            'San Ramon' => array(
                'Informatica Emplesarial' => 'Informatica Emplesarial',
                'Ingenieria Civil' => 'Ingenieria Civil',
            ),
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

