<?php
include_once '../public/header.php';

require_once '../util/SSession.php';

?>
<table>
    <tr>
        <th>Mail</th>
    </tr>
    <form enctype="multipart/form-data" method="POST" action="../business/LoginBusiness.php">
        <tr>
            <td>
                <input type="email" name="actormail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"/>
            </td>
            <td>
                <input type="submit" name="recover" value="Enviar"/> 
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