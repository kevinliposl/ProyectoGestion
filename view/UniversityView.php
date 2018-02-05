<?php
include_once '../public/header.php';
?>
<table>
    <tr>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Manejo de instalaciones</th>
    </tr>
    <form enctype="multipart/form-data" method='POST' action='../business/UniversityBusiness.php'>
        <tr>
            <td>
                <input type="text" name="universityname" pattern="[a-zA-Z\s]+$" placeholder="UCR &oacute; Universidad de Costa Rica"/>
            </td>
            <td>
                <select style="width: 100%" name="universitytype">
                    <option value="1">
                        Publica
                    </option>
                    <option value="0">
                        Privada
                    </option>
                </select>
            </td>
            <td>
                <select style="width: 100%" name="universityhadheadquarter">
                    <option value="1">
                        Sedes y Recintos
                    </option>
                    <option value="0">
                        Recintos
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
        echo "<input type ='hidden' name='universityid' value='" . $university['universityid'] . "'/>";
        echo "<tr>";
        echo "<td>";
        
        echo "<input type = 'text' name='universityname' value='" . $university['universityname'] . "' pattern ='[a-zA-Z\s]+$'/>";
        echo "</td>";
        echo "<td>";
        echo "<select style='width: 100%' name='universitytype'>";
            echo "<option ";if($university['universitytype']== 1){ echo "selected='selected'";} echo" value='1'>Publica</option>";
            echo "<option ";if($university['universitytype']== 0){ echo "selected='selected'";} echo" value='0'>Privada</option>";
        echo "</select>";
        echo "</td>";
        echo "<td>";
        echo "<select style='width: 100%' name='universityhadheadquarter' disabled>";
            echo "<option ";if($university['universityhadheadquarter']== 1){ echo "selected='selected'";} echo" value='1'>Sedes y Recintos</option>";
            echo "<option ";if($university['universityhadheadquarter']== 0){ echo "selected='selected'";} echo" value='0'>Recintos</option>";
        echo "</select>";
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
    