<?php

include_once '../public/header.php';
?>
<table>
    <tr>
        <th>Correo</th>
        <th>Contrasena</th>
       
    </tr>
     <form enctype="multipart/form-data" method='POST' action='../business/LoginBusiness.php'>
    <tr>
        <td>
            <input type ='text' name="loginMail" id="loginMail" placeholder="correo@proveedor.dominio"/>
        </td>
        <td>
            <input type ='password' name="loginPassword" id="loginPassword" placeholder="*******"/>
        </td>
      
        <td>
            <input type="submit" name="login" value="Login"/> 
        </td>
        <td>
            <a href="RecoverPasswordView.php">Recuperar contrasena</a>
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
                echo '<p style = "color: green">Sesión iniciada</p>';
            }
            ?>
        </td>
    </tr>
</table>

  

<?php

include_once '../public/footer.php';
