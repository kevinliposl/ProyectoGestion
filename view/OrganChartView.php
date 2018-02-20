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
$careers1 = $careerBusiness->selectAllByUniversity();

echo '<ul>';
foreach ($universities as $university) {
    echo '<li><a href="#"><div>' . $university['universityname'] . '</div></a>';
    if (intval($university['universityhadheadquarter']) == 1) {
        foreach ($headquarters as $headquarter) {
            echo '<ul>';
            echo '<li><a href="#"><div>' . $headquarter['headquartername'] . '</div></a>';
            echo '<ul>';
            if ($university['universityid'] == $headquarter['headquarteruniversityid']) {
                foreach ($enclosures as $enclosure) {
                    if ($enclosure['enclosureheadquarterid'] == $headquarter['headquarterid']) {
                        echo '<li><a href="#"><div>' . $enclosure['enclosurename'] . '</div></a>';
                        echo '<ul>';
                        foreach ($careers1 as $career) {
                            if ($enclosure['enclosureid'] == $career['careerenclosureid']) {
                                echo '<li><a href="#"><div>' . $career['careercode'] . ' | ' . $career['careername'] . ' | ' . $career['careergrade'] . '</div></a></li>';
                            }
                        }
                        echo '</ul>';
                        echo '</li>';
                    }
                }
            }
            echo '</ul>';
            echo '</li>';
            echo '</ul></br>';
        }
    } else {
        echo '<ul>';
        $careers2 = $careerBusiness->selectByEnclosure();
        foreach ($enclosures as $enclosure) {
            if ($university['universityid'] == $enclosure['enclosureuniversityid']) {
                echo '<li><a href="#"><div>' . $enclosure['enclosurename'] . '</div></a>';
                echo '<ul>';
                foreach ($careers2 as $career) {
                    if ($enclosure['enclosureid'] == $career['careerenclosureid']) {
                        echo '<li><a href="#"><div>' . $career['careercode'] . ' | ' . $career['careername'] . ' | ' . $career['careergrade'] . '</div></a></li>';
                    }
                }
                echo '</ul>';
                echo '</li>';
            }
        }
        echo '</ul>';
    }
    echo '</li>';
}
echo '</ul>';

include_once '../public/footer.php';

