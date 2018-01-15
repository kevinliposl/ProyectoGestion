<?php
include_once '../public/header.php';
?>
<table>
    <tr>
        <th>Carnet</th>
        <th>Nombre</th>
        <th>Primer Apellido</th>
        <th>Segundo Apellido</th>
        <th>Contrasenna</th>
        <th>Primer Carrera</th>
        <th>Segundo Carrera</th>
        <th>Sede</th>
    </tr>
    <form enctype="multipart/form-data" method='POST' action='../business/StudentBusiness.php'>
        <tr>
            <td>
                <input type ='text' name='carnet'/>
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
                <input type="password" name="password"/>
            </td>
            <td>
                <input type="text" name="career1"/>
            </td>
            <td>
                <input type="text" name="career2"/>
            </td>
            <td>
                <input type="text" name="headquarters"/>    
            </td>
            <td>
                <input type="submit" name="create" value="Crear"/> 
            </td>
            <td>
            </td>
        </tr>
    </form>

    <?php
    include '../business/StudentBusiness.php';

    $studentBusiness = new StudentBusiness();
    $students = $studentBusiness->selectAll();

    foreach ($students as $student) {

        echo "<form enctype='multipart/form-data' method='POST' action='../business/StudentBusiness.php'>";
        echo "<tr>";
        echo "<td>";
        echo "<input type ='text' name='carnet' value='" . $student['studentcarnet'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type = 'hidden' name='id' value='" . $student['studentid'] . "'/>";
        echo "<input type = 'text' name='name' value='" . $student['studentname'] . "' pattern ='[a-zA-Z\s]+$'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='text' name='lastname1' value='" . $student['studentlastname1'] . "' pattern ='[a-zA-Z\s]+$'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='text' name='lastname2' value='" . $student['studentlastname2'] . "' pattern ='[a-zA-Z\s]+$'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='password' name='password' value='" . $student['studentpassword'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type = 'text' name='career1' value='" . $student['studentcareer1'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='text' name='career2' value='" . $student['studentcareer2'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='text' name='headquarters' value='" . $student['studentheadquarters'] . "'/>";
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
    