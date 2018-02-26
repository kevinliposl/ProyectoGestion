<?php
include_once '../public/header.php';
require_once '../util/SSession.php';

if (!isset(SSession::getInstance()->user)) {
    header('location: ../index.php');
}
?>

<table>
    <tr>
        <th>Nueva Contrase&ncaron;a</th>
        <th>Confirmar Contrase&ncaron;a</th>
    </tr>
    <form enctype="multipart/form-data" method="POST" action="../business/LoginBusiness.php">
        <tr>
            <td>
                <input type="password" name="actorpassword1" placeholder="Contrase&ncaron;a"/>
            </td>
            <td>
                <input type="password" name="actorpassword2" placeholder="Confirmar Contrase&ncaron;a"/>
            </td>
            <td>
                <input type="submit" name="update" value="Guardar"/> 
            </td>
        </tr>
    </form>

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