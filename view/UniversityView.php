<?php
include_once '../public/header.php';
?>
<table>
    <tr>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Tipo</th>
       
    </tr>
    <form enctype="multipart/form-data" method='POST' action='../business/UniversityBusiness.php'>
        <tr>
            <td>
                <input type ='text' name='code' pattern="[0-9]{6}"/>
            </td>
            <td>
                <input type="text" name="name" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <input type="text" name="type" pattern="[0-1]{1}"/>
            </td>
            <td>
                <input type="submit" name="create" value="Crear"/> 
            </td>
            <td>
            </td>
        </tr>
    </form>

    <?php
    include '../business/UniversityBusiness.php';

    $universityBusiness = new UniversityBusiness();
    $universities = $universityBusiness->selectAll();

    foreach ($universities as $university) {

        echo "<form enctype='multipart/form-data' method='POST' action='../business/UniversityBusiness.php'>";
        echo "<tr>";
        echo "<td>";
        echo "<input type ='text' name='code' value='" . $university['universitycode'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type = 'text' name='name' value='" . $university['universityname'] . "' pattern ='[a-zA-Z\s]+$'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type = 'text' name='type' value='" . $university['universitytype'] . "' pattern ='[0-1]{1}'/>";
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