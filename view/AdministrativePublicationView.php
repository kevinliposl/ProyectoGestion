<?php
include_once '../public/header.php';

include_once '../business/PublicationBusiness.php';
$eventBusiness = new PublicationBusiness();

require_once '../util/SSession.php';

if (!isset(SSession::getInstance()->user)) {
    header('location: ../index.php');
}
?>
<table>
    <tr>
        <th>Titulo</th>
        <th>Descripcion</th>
    </tr>
    <form enctype="multipart/form-data" method='POST' action='../business/PublicationBusiness.php'>
        <tr>
            <td>
                <input type="text" name="title"/>
            </td>
            <td>
                <input type ='text' name="description"/>
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

        echo "<form enctype='multipart/form-data' method='POST' action='../business/PublicationBusiness.php'>";
        echo "<tr>";
        echo "<td>";
        echo "<input type ='text' name='title' value='" . $event['activitytitle'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='text' name='description' value='" . $event['activitydescription'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type = 'hidden' name='eventid' value='" . $event['activityid'] . "'/>";
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