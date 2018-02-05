<?php
include_once '../public/header.php';

//include_once '../business/';
//$professorBusiness = new ProfessorBusiness();
?>
<table>
    <tr>
        <th>Mail</th>
        <th>Licencia</th>
        <th>Nombre</th>
        <th>Primer Apellido</th>
        <th>Segundo Apellido</th>
        <th>Departamento</th>
        <th>Contrase&ncaron;a</th>        
    </tr>
    <form enctype="multipart/form-data" method='POST' action='../business/AdministrativeBusiness.php'>
        <tr>
            <td>
                <input type ='text' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name='administrativemail'/>
            </td>
            <td>
                <input type ='text' name='administrativelicense'/>
            </td>
            <td>
                <input type="text" name="administrativename" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <input type="text" name="administrativelastname1" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <input type="text" name="administrativelastname2" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <input type="text" name="administrativearea" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <input type="password" name="administrativepassword"/>
            </td>
            <td>
                <input type="submit" name="create" value="Crear"/> 
            </td>
            <td>
            </td>
        </tr>
    </form>
    
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
    