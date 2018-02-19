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
            <input type ='text' id="loginMail" placeholder="correo@proveedor.dominio"/>
        </td>
        <td>
            <input type ='text' id="loginPassword" placeholder="*******"/>
        </td>
      
        <td>
            <input type="button" id="search" value="Login!"/> 
        </td>
        <td>
            <a href="#">Recuperar contrasena</a>
        </td>
        
    </tr>
     </form>
</table>
<script>
    
</script>

<?php

include_once '../public/footer.php';
