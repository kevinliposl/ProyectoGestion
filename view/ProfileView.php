<?php

include_once '../public/header.php';

include_once '../business/ProfessorBusiness.php';
$professorBusiness = new ProfessorBusiness();

include_once '../business/AdministrativeBusiness.php';
$administrativeBusiness = new AdministrativeBusiness();

include_once '../business/StudentBusiness.php';
$studentBusiness = new StudentBusiness();

include_once '../business/CareerBusiness.php';
$careerBusiness = new CareerBusiness();

include_once '../business/UniversityBusiness.php';
$universityBusiness = new UniversityBusiness();

require_once '../util/SSession.php';

if (!isset(SSession::getInstance()->user)) {
    header('location: ../index.php');
}
?>

<?php

if (SSession::getInstance()->user['actorchangedpassword'] == 0) {
    echo '<h1>Cambie su contrase&ncaron;a</h1>';
}

if (SSession::getInstance()->user['type'] == "student") {//estudiante
    echo "<table>";
    echo "<tr>";
    echo "<th>Mail</th>";
    echo "<th>Identificaci&oacute;n</th>";
    echo "<th>Nombre</th>";
    echo "<th>Primer Apellido</th>";
    echo "<th>Segundo Apellido</th>";
    echo "<th>Contrase&ncaron;a</th>";
    echo "<th>Primer Carrera</th>";
    echo "<th>Segundo Carrera</th>";
    echo "</tr>";
    $universities = $universityBusiness->selectAll();
    $careers = $careerBusiness->selectAllByUniversity();
    if (SSession::getInstance()->user['actorid']) {
        echo "<form enctype='multipart/form-data' method='POST' action='../business/StudentBusiness.php'>";
        echo "<tr>";
        echo "<td>";
        echo "<input pattern = "."[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"." type ='text' name='studentmail' value='" . SSession::getInstance()->user['actormail'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input pattern = ".'[A-Za-z0-9]{5,11}'." type ='text' name='studentlicense' value='".SSession::getInstance()->user['studentlicense']."'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type = 'hidden' name='studentid' value='" . SSession::getInstance()->user['studentid'] . "'/>";
        echo "<input pattern = "."[A-Za-záéíóúÁÉÍÓÚÑñ]{3,50}"." type = 'text' name='studentname' value='" . SSession::getInstance()->user['studentname'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input pattern= "."[A-Za-z0-9]{3,50}"." type ='text' name='studentlastname1' value='" . SSession::getInstance()->user['studentlastname1'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input pattern= "."[A-Za-z0-9]{3,50}"." type ='text' name='studentlastname2' value='" . SSession::getInstance()->user['studentlastname2'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input pattern= "."(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"." type ='password' name='studentpassword' value='" . SSession::getInstance()->user['studentpassword'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<select name='studentcareer1' style='width: 100%'>";

        $cambio = 0;
        foreach ($careers as $career) {
            if (intval($career['careerid']) == intval(SSession::getInstance()->user['studentcareer1'])) {
                $var = "selected='selected'";
            } else {
                $var = "";
            }

            if ($cambio === 0 && strcmp($career['universityname'], $career['universityname']) === 0) {
                $cambio = 1;
                echo "<optgroup label='" . $career['universityname'] . "'>";
                echo "<option " . $var . " value='" . $career['careerid'] . "'>" . $career['careername'] . " | " . $career['enclosurename'] . "</option>";
            } else {
                if (current($careers)['universityname'] != "" and next($careers)['universityname'] != $career['universityname'] && $cambio === 1) {
                    $cambio = 0;
                }
                echo "<option " . $var . " value='" . $career['careerid'] . "'>" . $career['careername'] . " | " . $career['enclosurename'] . "</option>";
            }
        }
        echo "</select>";
        echo "<td>";
        echo "<select name='studentcareer2' style='width: 100%'>";
        echo "<option value='0'>Ninguna</option>";
        $cambio = 0;
        foreach ($careers as $career) {
            if (intval($career['careerid']) == intval(SSession::getInstance()->user['studentcareer2'])) {
                $var = "selected='selected'";
            } else {
                $var = "";
            }

            if ($cambio === 0 && strcmp($career['universityname'], $career['universityname']) === 0) {
                $cambio = 1;
                echo "<optgroup label='" . $career['universityname'] . "'>";
                echo "<option " . $var . " value='" . $career['careerid'] . "'>" . $career['careername'] . " | " . $career['enclosurename'] . "</option>";
            } else {
                if (current($careers)['universityname'] != "" and next($careers)['universityname'] != $career['universityname'] && $cambio === 1) {
                    $cambio = 0;
                }
                echo "<option " . $var . " value='" . $career['careerid'] . "'>" . $career['careername'] . " | " . $career['enclosurename'] . "</option>";
            }
        }
        echo "</select>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='submit' name='update' value ='Actualizar'/>";
        echo "</td>";
        echo "</tr>";
        echo "</form>";
    }
} else if (SSession::getInstance()->user['type'] == "professor") {//profesor
    if (SSession::getInstance()->user['actorid']) {
        echo "<table>";
        echo "<tr>";
        echo "<th>Mail</th>";
        echo "<th>Licencia</th>";
        echo "<th>Nombre</th>";
        echo "<th>Primer Apellido</th>";
        echo "<th>Segundo Apellido</th>";
        echo "<th>Contrase&ncaron;a</th>";
        echo "</tr>";
        echo "<form enctype='multipart/form-data' method='POST' action='../business/ProfessorBusiness.php'>";
        echo "<tr>";
        echo "<td>";
        echo "<input  pattern = "."[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"." type ='text' name='professormail' value='" . SSession::getInstance()->user['actormail'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input pattern = "."[A-Za-z0-9]{5,11}"." type ='text' name='professorlicense' value='" . trim(SSession::getInstance()->user['professorlicense']) . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type = 'hidden' name='professorid' value='" . SSession::getInstance()->user['professorid'] . "'/>";
        echo "<input pattern = "."[A-Za-záéíóúÁÉÍÓÚÑñ]{3,50}"." type = 'text' name='professorname' value='" . SSession::getInstance()->user['professorname'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input pattern = "."[A-Za-záéíóúÁÉÍÓÚÑñ]{3,50}"." type ='text' name='professorlastname1' value='" . SSession::getInstance()->user['professorlastname1'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input pattern = ".'[A-Za-záéíóúÁÉÍÓÚÑñ]{3,50}'." type ='text' name='professorlastname2' value='" . SSession::getInstance()->user['professorlastname2'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input pattern= "."(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"." type ='password' name='professorpassword' value='" . SSession::getInstance()->user['professorpassword'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='submit' name='update' value ='Actualizar'/>";
        echo "</td>";
        echo "</tr>";
        echo "</form>";
    }//End if
} else if (SSession::getInstance()->user['type'] == "administrative") {//administrativo
    if (SSession::getInstance()->user['actorid']) {
        echo "<table>";
        echo "<tr>";
        echo "<th>Mail</th>";
        echo "<th>Licencia</th>";
        echo "<th>Nombre</th>";
        echo "<th>Primer Apellido</th>";
        echo "<th>Segundo Apellido</th>";
        echo "<th>Departamento</th>";
        echo "<th>Contrase&ncaron;a</th>";
        echo "</tr>";
        echo "<form enctype='multipart/form-data' method='POST' action='../business/AdministrativeBusiness.php'>";
        echo "<tr>";
        echo "<td>";
        echo "<input type ='text' name='administrativemail' value='" . SSession::getInstance()->user['actormail'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='text' name='administrativelicense' value='" . SSession::getInstance()->user['administrativelicense'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type = 'hidden' name='administrativeid' value='" . SSession::getInstance()->user['administrativeid'] . "'/>";
        echo "<input type = 'text' name='administrativename' value='" . SSession::getInstance()->user['administrativename'] . "' pattern ='[a-zA-Z\s]+$'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='text' name='administrativelastname1' value='" . SSession::getInstance()->user['administrativelastname1'] . "' pattern ='[a-zA-Z\s]+$'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='text' name='administrativelastname2' value='" . SSession::getInstance()->user['administrativelastname2'] . "' pattern ='[a-zA-Z\s]+$'/>";
        echo "</td>";
        echo "<td>";
        echo "<select id='typeadministrative' name='administrativearea' style='width: 100%'>";
        echo "<option value='" . SSession::getInstance()->user['administrativearea'] . "'>" . SSession::getInstance()->user['administrativearea'] . "</option>";
        echo "<option value='admision'>admision</option>";
        echo "<option value='matricula'>matricula</option>";
        echo "<option value='becas'>becas</option>";
        echo "<option value='serviciosEstudiantiles'>Servicios Estudiantiles</option>";
        echo "<option value='infraestructura'>Infraestructura</option>";
        echo "<option value='transporte'>Transporte</option>";
        echo "<option value='trabajoComunal'>Trabajo comunal</option>";
        echo "<option value='proyectosInvestigacion'>Proyectos de Investigacion</option>";
        echo "<option value='AccionSocial'>Accion Social</option>";
        echo "<option value='ExtensionCultural'>Extension Cultural</option>";
        echo "</select>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='password' name='administrativepassword' value='" . SSession::getInstance()->user['administrativepassword'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='submit' name='update' value ='Actualizar'/>";
        echo "</td>";
        echo "</tr>";
        echo "</form>";
    }
}//End if-else-if-else
?>
<?php

include_once '../public/footer.php';


