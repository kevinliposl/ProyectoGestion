<?php
include_once '../public/header.php';

include_once '../business/EventBusiness.php';
$eventBusiness = new EventBusiness();

include_once '../business/EnclosureBusiness.php';
$enclosureBusiness = new EnclosureBusiness();   
                    
include_once '../business/UniversityBusiness.php';
$universityBusiness = new UniversityBusiness();
?>
<table>
    <tr>
        <th>Titulo</th>
        <th>Descripcion</th>
        <th>Lugar</th>
        <th>Dia del Evento</th>
        <th>Hora del evento</th>
        <th>Dias despues</th>
        <th>Dias antes</th>
        <th>Sede de la publicación</th>
    </tr>
    <form enctype="multipart/form-data" method='POST' action='../business/EventBusiness.php'>
        <tr>
            <td>
                <input type="text" name="title"/>
            </td>
            <td>
                <input type ='text' name="description"/>
            </td>
            <td>
                <input type="text" name="place"/>
            </td>
            <td>
                <input type="date" name="dateEvent"/>
            </td>
            <td>
                <input type="time" name="hourEvent"/>
            </td>
            <td>
                <input type="number" name="hourAfter" min="0" step="1"/>
            </td>
            <td>
                <input type="number" name="hourBefore" min="0" step="1"/>
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
    $event = $eventBusiness->selectAll();

    foreach ($event as $event) {

        echo "<form enctype='multipart/form-data' method='POST' action='../business/EventBusiness.php'>";
        echo "<tr>";
        echo "<td>";
        echo "<input type ='text' name='title' value='" . $event['activitytitle'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='text' name='description' value='" . $event['activitydescription'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type = 'hidden' name='eventid' value='" . $event['activityid'] . "'/>";
        echo "<input type = 'text' name='place' value='" . $event['eventplace'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='date' name='dateEvent' value='" . $event['eventdate'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='time' name='hourEvent' value='" . $event['eventhour'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='number' name='hourAfter' value='" . $event['dayafter'] . "' min='0' step='1'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='number' name='hourBefore' value='" . $event['daybefore'] . "' min='0' step='1'/>";
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