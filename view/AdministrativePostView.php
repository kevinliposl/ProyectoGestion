<?php
include_once '../public/header.php';

include_once '../business/PostBusiness.php';
$postBusiness = new PostBusiness();
?>
<table>
    <tr>
        <th>Titulo</th>
        <th>Descripcion</th>
          <th>Dias despues</th>
        <th>Dias antes</th>
    </tr>
    <form enctype="multipart/form-data" method='POST' action='../business/PostBusiness.php'>
        <tr>
            <td>
                <input type="text" name="title"/>
            </td>
            <td>
                <input type ='text' name="description"/>
            </td>
                <td>
                <input type="number" name="hourAfter"/>
            </td>
            <td>
                <input type="number" name="hourBefore"/>
            </td>
            <td>
                <input type="submit" name="create" value="Crear"/> 
            </td>
            <td>
            </td>
        </tr>
    </form>

    <?php
    $posts = $postBusiness->selectAll();

    foreach ($posts as $post) {

        echo "<form enctype='multipart/form-data' method='POST' action='../business/PostBusiness.php'>";
        echo "<tr>";
        echo "<td>";
        echo "<input type ='text' name='title' value='" . $post['activitytitle'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type = 'hidden' name='postid' value='" . $post['activityid'] . "'/>";
        echo "<input type ='text' name='description' value='" . $post['activitydescription'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='number' name='hourAfter' value='" . $post['dayafter'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='number' name='hourBefore' value='" . $post['daybefore'] . "'/>";
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