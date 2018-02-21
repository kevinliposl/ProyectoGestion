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
?>

<?php

if(SSession::getInstance()->user['type'] == "student"){//estudiante
    $universities = $universityBusiness->selectAll();
    $careers = $careerBusiness->selectAllByUniversity();

    foreach ($universities as $university) {
        $universityname = $university['universityname'];
        ?>
            
                                    <optgroup label="<?= $universityname; ?>">
            
        <?php
        foreach ($careers as $career) {
            if ($career['universityname'] == $universityname) {
                ?>
                            
                                                                <option value=" <?= $career['careerid']; ?> "> <?= $career['careerid'] . " | " . $career['careername'] . " | " . $career['enclosurename']; ?> </option>
                            
                <?php
            }
        }
    }
    ?>
    
                    </select>
                </td>
                <td>
                    <select name="studentcareer2" style="width: 100%">
                        <option value="0">Ninguna</option>
    
    <?php
    foreach ($universities as $university) {
        $universityname = $university['universityname'];
        ?>
            
                                    <optgroup label="<?= $universityname; ?>">
            
        <?php
        foreach ($careers as $career) {
            if ($career['universityname'] == $universityname) {
                ?>
                            
                                                                <option value=" <?= $career['careerid']; ?> "> <?= $career['careerid'] . " | " . $career['careername'] . " | " . $career['enclosurename']; ?> </option>
                            
                <?php
            }
        }
    }
    ?>
                    </select>
                </td>
                <td>
                    <input type="submit" name="create" value="Crear"/> 
                </td>
            </tr>
        </form>-->

    <?php
    $students = $studentBusiness->selectAll();

    foreach ($students as $student) {
        if(SSession::getInstance()->user['actorid'] == $professor['studentid']){
            echo "<form enctype='multipart/form-data' method='POST' action='../business/StudentBusiness.php'>";
            echo "<tr>";
            echo "<td>";
            echo "<input type ='text' name='studentmail' value='" . $student['actormail'] . "'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type ='text' name='studentlicense' value='" . $student['studentlicense'] . "'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type = 'hidden' name='studentid' value='" . $student['studentid'] . "'/>";
            echo "<input type = 'text' name='studentname' value='" . $student['studentname'] . "' pattern ='[a-zA-Z\s]+$'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type ='text' name='studentlastname1' value='" . $student['studentlastname1'] . "' pattern ='[a-zA-Z\s]+$'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type ='text' name='studentlastname2' value='" . $student['studentlastname2'] . "' pattern ='[a-zA-Z\s]+$'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type ='password' name='studentpassword' value='" . $student['studentpassword'] . "'/>";
            echo "</td>";
            echo "<td>";
            echo "<select name='studentcareer1' style='width: 100%'>";

            $cambio = 0;
            foreach ($careers as $career) {
                if (intval($career['careerid']) == intval($student['studentcareer1'])) {
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
                if (intval($career['careerid']) == intval($student['studentcareer2'])) {
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
    }
}else if(SSession::getInstance()->user['type'] == "professor"){//profesor
    
    $professors = $professorBusiness->selectAll();
    
    foreach ($professors as $professor) {
        if(SSession::getInstance()->user['actorid'] == $professor['professorid']){
            echo "<form enctype='multipart/form-data' method='POST' action='../business/ProfessorBusiness.php'>";
            echo "<tr>";
            echo "<td>";
            echo "<input type ='text' name='professormail' value='" . $professor['actormail'] . "'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type ='text' name='professorlicense' value='" . $professor['professorlicense'] . "'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type = 'hidden' name='professorid' value='" . $professor['professorid'] . "'/>";
            echo "<input type = 'text' name='professorname' value='" . $professor['professorname'] . "' pattern ='[a-zA-Z\s]+$'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type ='text' name='professorlastname1' value='" . $professor['professorlastname1'] . "' pattern ='[a-zA-Z\s]+$'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type ='text' name='professorlastname2' value='" . $professor['professorlastname2'] . "' pattern ='[a-zA-Z\s]+$'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type ='password' name='professorpassword' value='" . $professor['professorpassword'] . "'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type ='submit' name='update' value ='Actualizar'/>";
            echo "</td>";
            echo "</tr>";
            echo "</form>";
        }//End if
    }//End foreach
    
}else if (SSession::getInstance()->user['type'] == "administrative"){//administrativo
    $administratives = $administrativeBusiness->selectAll();
    foreach ($administratives as $administrative) {
        if(SSession::getInstance()->user['actorid'] == $professor['administrativeid']){

            echo "<form enctype='multipart/form-data' method='POST' action='../business/AdministrativeBusiness.php'>";
            echo "<tr>";
            echo "<td>";
            echo "<input type ='text' name='administrativemail' value='" . $administrative['actormail'] . "'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type ='text' name='administrativelicense' value='" . $administrative['administrativelicense'] . "'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type = 'hidden' name='administrativeid' value='" . $administrative['administrativeid'] . "'/>";
            echo "<input type = 'text' name='administrativename' value='" . $administrative['administrativename'] . "' pattern ='[a-zA-Z\s]+$'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type ='text' name='administrativelastname1' value='" . $administrative['administrativelastname1'] . "' pattern ='[a-zA-Z\s]+$'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type ='text' name='administrativelastname2' value='" . $administrative['administrativelastname2'] . "' pattern ='[a-zA-Z\s]+$'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type ='text' name='administrativearea' value='" . $administrative['administrativearea'] . "' pattern ='[a-zA-Z\s]+$'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type ='password' name='administrativepassword' value='" . $administrative['administrativepassword'] . "'/>";
            echo "</td>";
            echo "<td>";
            echo "<input type ='submit' name='update' value ='Actualizar'/>";
            echo "</td>";
            echo "</tr>";
            echo "</form>";
        }
    }
}//End if-else-if-else
?>
<?php
    include_once '../public/footer.php';
    

