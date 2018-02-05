<?php
include_once '../public/header.php';

include_once '../business/ProfessorBusiness.php';
$professorBusiness = new ProfessorBusiness();
?>
<table>
    <tr>
        <th>Mail</th>
        <th>Licencia</th>
        <th>Nombre</th>
        <th>Primer Apellido</th>
        <th>Segundo Apellido</th>
        <th>Contrase&ncaron;a</th>        
    </tr>
    <form enctype="multipart/form-data" method='POST' action='../business/ProfessorBusiness.php'>
        <tr>
            <td>
                <input type ='email' name='professormail'/>
            </td>
            <td>
                <input type ='text' name='professorlicense'/>
            </td>
            <td>
                <input type="text" name="professorname" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <input type="text" name="professorlastname1" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <input type="text" name="professorlastname2" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <input type="password" name="professorpassword"/>
            </td>
            <td>
                <input type="submit" name="create" value="Crear"/> 
            </td>
            <td>
            </td>
        </tr>
    </form>

    <?php
    $professors = $professorBusiness->selectAll();

    foreach ($professors as $professor) {

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
                    echo '<p style="color: red">Campo(s) vacio(s)</p>';
                } else if ($_GET['error'] == "format") {
                    echo '<p style="color: red">Error, formato de numero</p>';
                } else if ($_GET['error'] == "dbError") {
                    echo '<center><p style="color: red">Error al procesar la transacción</p></center>';
                }
            } else if (isset($_GET['success'])) {
                echo '<p style="color: green">Transacción realizada</p>';
            }
            ?>
        </td>
    </tr>

    <?php
    include_once '../public/footer.php';
    