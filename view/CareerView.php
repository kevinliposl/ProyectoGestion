<?php
include_once '../public/header.php';
?>
<table>
    <tr>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Grado</th>
        <th>Recinto</th>

    </tr>
    <form enctype="multipart/form-data" method='POST' action='../business/CareerBusiness.php'>
        <tr>
            <td>
                <input type ='text' name='code' pattern="[0-9]{6}"/>
            </td>
            <td>
                <input type="text" name="name" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <select id="enclosure" name="enclosure" style="width: 100%">
                    <option value="Diplomado">Diplomado</option>
                    <option value="Bachillerato">Bachillerato</option>
                    <option value="Licenciatura">Licenciatura</option>
                    <option value="Maestria">Maestria</option>
                    <option value="Doctorado">Doctorado</option>
                </select>
            </td>
            <td>
                <select id="enclosure" name="enclosure" style="width: 100%">
                    <option value="0">Ninguna</option>

                    <?php
                    include '../business/EnclosureBusiness.php';
                    $enclosureBusiness = new EnclosureBusiness();

                    $enclosures = $enclosureBusiness->selectAllByUniversity();
                    $cambio = 0;

                    foreach ($enclosures as $enclosure) {
                        if ($cambio == 0 && strcmp(current($enclosures)['universityname'], $enclosure['universityname']) === 0) {
                            $cambio = 1;
                            ?>

                            <optgroup label="<?= $enclosure['universityname']; ?>">
                                <option value="<?= $enclosure['enclosureid']; ?>" ><?= $enclosure['enclosureid'] . " | " . $enclosure['enclosurename'] . ' | ' . $enclosure['headquartername']; ?></option>

                                <?php
                            } else {
                                if (current($enclosures)['universityname'] != "" and next($enclosures)['universityname'] != $enclosure['universityname'] && $cambio == 1) {
                                    $cambio = 0;
                                }
                                ?>

                                <option value="<?= $enclosure['enclosureid']; ?>" ><?= $enclosure['enclosureid'] . " | " . $enclosure['enclosurename'] . ' | ' . $enclosure['headquartername']; ?></option>

                                <?php
                            }
                        }
                        ?>
                </select>
            </td>
            <td>
                <input type="submit" name="create" value="Crear"/> 
            </td>
            <td>
            </td>
        </tr>
    </form>

    <?php
    include '../business/CareerBusiness.php';
    echo 'AGREGAR LOS DEMAS CAMPOS Y ACTUALIZAR POR ID NO POR CODIGO<br>';
    $careerBusiness = new CareerBusiness();
    $careers = $careerBusiness->selectAll();

    foreach ($careers as $career) {
        echo "<form enctype='multipart/form-data' method='POST' action='../business/CareerBusiness.php'>";
        echo "<tr>";
        echo "<td>";
        echo "<input type ='text' name='code' value='" . $career->getCareercode() . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type = 'text' name='name' value='" . $career->getCareername() . "' pattern ='[a-zA-Z\s]+$'/>";
        echo "</td>";
        echo "<td>";
        echo "<select id='enclosure' name='enclosure' style='width: 100%'>";
        echo "<option value='Diplomado'>Diplomado</option>";
        echo "<option value='Bachillerato'>Bachillerato</option>";
        echo "<option value='Licenciatura'>Licenciatura</option>";
        echo "<option value='Maestria'>Maestria</option>";
        echo "<option value ='Doctorado'>Doctorado</option>";
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
    