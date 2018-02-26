<?php
include_once '../public/header.php';

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
<table>
    <tr>
        <th>Mail</th>
        <th>Identificaci&oacute;n</th>
        <th>Nombre</th>
        <th>Primer Apellido</th>
        <th>Segundo Apellido</th>
        <th>Contrase&ncaron;a</th>
        <th>Primer Carrera</th>
        <th>Segundo Carrera</th>
    </tr>
    <!--    <form enctype="multipart/form-data" method='POST' action='../business/StudentBusiness.php'>
            <tr>
                <td>
                    <input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="studentmail"/>
                </td>
                <td>
                    <input type ='text' name="studentlicense"/>
                </td>
                <td>
                    <input type="text" name="studentname" pattern="[a-zA-Z\s]+$"/>
                </td>
                <td>
                    <input type="text" name="studentlastname1" pattern="[a-zA-Z\s]+$"/>
                </td>
                <td>
                    <input type="text" name="studentlastname2" pattern="[a-zA-Z\s]+$"/>
                </td>
                <td>
                    <input type="password" name="studentpassword"/>
                </td>
                <td>
    
                    <select name="studentcareer1" style="width: 100%">
                        <option value="0">Ninguna</option>
    
    <?php
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
        echo "<input type ='submit' name='delete' value ='Eliminar'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='submit' name='update' value ='Actualizar'/>";
        echo "</td>";
        echo "</tr>";
        echo "</form>";
    }
    ?>

    <tr>
        <td></td>
        <td>
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "empty") {
                    echo '<p style = "color: red">Campo(s) vacio(s)</p>';
                } else if ($_GET['error'] == "format") {
                    echo '<p style = "color: red">Error, formato de numero</p>';
                } else if ($_GET['error'] == "dbError") {
                    echo '<center><p style = "color: red">Error al procesar la transacción</p></center>';
                }
            } else if (isset($_GET['success'])) {
                echo '<p style = "color: green">Transacción realizada</p>';
            }
            ?>
        </td>
    </tr>

    <?php
    include_once '../public/footer.php';
    ?>