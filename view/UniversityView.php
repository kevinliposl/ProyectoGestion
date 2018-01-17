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
                <input type ='text' name='code' pattern="[0-9]{6}" placeholder="123456"/>
            </td>
            <td>
                <input type="text" name="name" pattern="[a-zA-Z\s]+$" placeholder="UCR &oacute; Universidad de Costa Rica"/>
            </td>
            <td>
                <select style="width: 100%" name="type">
                    <option value="1">
                        Publica
                    </option>
                    <option value="0">
                        Privada
                    </option>
                </select>
            </td>
            <td>
                <input type="submit" name="create" value="Crear"/> 
            </td>
        </tr>
    </form>

    <?php
    include '../business/UniversityBusiness.php';

    $universityBusiness = new UniversityBusiness();
    $universities = $universityBusiness->selectAll();

    foreach ($universities as $university) {

        echo "<form enctype='multipart/form-data' method='POST' action='../business/UniversityBusiness.php'>";
        echo "<input type ='hidden' name='id' value='" . $university->getUniversityid() . "'/>";
        echo "<tr>";
        echo "<td>";
        echo "<input type ='text' name='code' value='" . $university->getUniversityCode() . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type = 'text' name='name' value='" . $university->getUniversityName() . "' pattern ='[a-zA-Z\s]+$'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type = 'text' name='type' value='" . $university->getUniversityType() . "' pattern ='[0-1]{1}'/>";
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
    