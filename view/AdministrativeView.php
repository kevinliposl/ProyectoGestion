<?php
include_once '../public/header.php';

//include_once '../business/ProfessorBusiness.php';
//$professorBusiness = new ProfessorBusiness();
?>
<table>
    <tr>
        <th>Mail</th>
        <th>Licencia</th>
        <th>Nombre</th>
        <th>Primer Apellido</th>
        <th>Segundo Apellido</th>
        <th>Area</th>
        <th>Contrase&ncaron;a</th>        
    </tr>
    <form enctype="multipart/form-data" method='POST' action='../business/ProfessorBusiness.php'>
        <tr>
            <td>
                <input type ='text' name='mail'/>
            </td>
            <td>
                <input type ='text' name='license'/>
            </td>
            <td>
                <input type="text" name="name" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <input type="text" name="lastname1" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <input type="text" name="lastname2" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <input type="text" name="area" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <input type="password" name="password"/>
            </td>
            <td>
                <input type="submit" name="create" value="Crear"/> 
            </td>
            <td>
            </td>
        </tr>
    </form>

    <?php
//    
//    $professors = $professorBusiness->selectAll();
//
//    foreach ($professors as $professor) {
//
//        echo "<form enctype='multipart/form-data' method='POST' action='../business/ProfessorBusiness.php'>";
//        echo "<tr>";
//        echo "<td>";
//        echo "<input type ='text' name='license' value='" . $professor['professorlicense'] . "'/>";
//        echo "</td>";
//        echo "<td>";
//        echo "<input type = 'hidden' name='id' value='" . $professor['professorid'] . "'/>";
//        echo "<input type = 'text' name='name' value='" . $professor['professorname'] . "' pattern ='[a-zA-Z\s]+$'/>";
//        echo "</td>";
//        echo "<td>";
//        echo "<input type ='text' name='lastname1' value='" . $professor['professorlastname1'] . "' pattern ='[a-zA-Z\s]+$'/>";
//        echo "</td>";
//        echo "<td>";
//        echo "<input type ='text' name='lastname2' value='" . $professor['professorlastname2'] . "' pattern ='[a-zA-Z\s]+$'/>";
//        echo "</td>";
//        echo "<td>";
//        echo "<input type ='text' name='area' value='" . $professor['professorarea'] . "' pattern ='[a-zA-Z\s]+$'/>";
//        echo "</td>";
//        echo "<td>";
//        echo "<input type ='password' name='password' value='" . $professor['professorpassword'] . "'/>";
//        echo "</td>";
//        echo "<td>";
//        echo "<input type ='submit' name='delete' value ='Eliminar'/>";
//        echo "</td>";
//        echo "<td>";
//        echo "<input type ='submit' name='update' value ='Actualizar'/>";
//        echo "</td>";
//        echo "</tr>";
//        echo "</form>";
//    }
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
    