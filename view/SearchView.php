<?php
include_once '../public/header.php';
?>
<table>
    <tr>
        <th>Busqueda General</th>
        <th>Fecha</th>
        <th>Tipo de Actividad</th>
    </tr>
    <form enctype="multipart/form-data" method='POST' action='../business/CommentBusiness.php'>
        <tr>
            <td>
                <input type ='text' name="searchGeneral" placeholder="Busqueda General"/>
            </td>
            <td>
                <input type ='text' name="searchDate" placeholder="Fecha"/>
            </td>
            <td>
                <select>
                    <option value="0">Evento</option>
                    <option value="1">Actividad</option>
                </select>
            </td>
            <td>
                <input type="submit" name="create" value="Crear"/> 
            </td>
            <td>
            </td>
        </tr>
    </form>
</table>

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
