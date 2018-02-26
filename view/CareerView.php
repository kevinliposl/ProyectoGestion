<?php
include_once '../public/header.php';

include_once '../business/EnclosureBusiness.php';
$enclosureBusiness = new EnclosureBusiness();

include_once '../business/UniversityBusiness.php';
$universityBusiness = new UniversityBusiness();

require_once '../util/SSession.php';

if (!isset(SSession::getInstance()->user)) {
    header('location: ../index.php');
}
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
                <input type ='text' name='careercode'/>
            </td>
            <td>
                <input type="text" name="careername" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <select name="careergrade" style="width: 100%">
                    <option value="Diplomado">Diplomado</option>
                    <option value="Bachillerato">Bachillerato</option>
                    <option value="Licenciatura">Licenciatura</option>
                    <option value="Maestria">Maestria</option>
                    <option value="Doctorado">Doctorado</option>
                </select>
            </td>
            <td>
                <select name="careerenclosure" style="width: 100%">
                    <option value="0">Ninguna</option>

                    <?php
                    $enclosures = $enclosureBusiness->selectAllByUniversity();
                    $universities = $universityBusiness->selectAll();


                    foreach ($universities as $university) {
                        $universityname = $university['universityname'];
                        ?>

                        <optgroup label="<?= $universityname; ?>">

                            <?php
                            foreach ($enclosures as $enclosure) {
                                if (strcmp($enclosure['universityname'], $universityname) === 0) {
                                    ?>
                                    <option value="<?= $enclosure['enclosureid']; ?>"><?= $enclosure['enclosureid'] . " | " . $enclosure['enclosurename'] . " | " . $enclosure['headquartername']; ?></option>

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
            <td>
            </td>
        </tr>
    </form>

    <?php
    include '../business/CareerBusiness.php';
    $careerBusiness = new CareerBusiness();
    $careers = $careerBusiness->selectAll();

    foreach ($careers as $career) {
        echo "<form enctype='multipart/form-data' method='POST' action='../business/CareerBusiness.php'>";
        echo "<tr>";
        echo "<td>";
        echo "<input type ='hidden' name='careerid' value='" . $career->getCareerid() . "'/>";
        echo "<input type ='text' name='careercode' value='" . $career->getCareercode() . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type = 'text' name='careername' value='" . $career->getCareername() . "' pattern ='[a-zA-Z\s]+$'/>";
        echo "</td>";
        echo "<td>";
        echo "<select name='careergrade' style='width: 100%'>";
        echo "<option";
        if ($career->getCareergrade() == "Diplomado") {
            echo " selected='selected'";
        } echo" value='Diplomado'>Diplomado</option>";
        echo "<option";
        if ($career->getCareergrade() == "Bachillerato") {
            echo " selected='selected'";
        } echo " value='Bachillerato'>Bachillerato</option>";
        echo "<option";
        if ($career->getCareergrade() == "Licenciatura") {
            echo " selected='selected'";
        } echo " value='Licenciatura'>Licenciatura</option>";
        echo "<option";
        if ($career->getCareergrade() == "Maestria") {
            echo " selected='selected'";
        } echo " value='Maestria'>Maestria</option>";
        echo "<option";
        if ($career->getCareergrade() == "Doctorado") {
            echo " selected='selected'";
        } echo " value ='Doctorado'>Doctorado</option>";
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
    