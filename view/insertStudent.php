<?php
include_once '../public/headerIN.php';
?>


<form method="POST" onsubmit="return false;" action="../business/StudentBusiness.php">
    <div>
        <label for="name">Correo:</label>
        <input type="text" id="form-mail" name="form-mail" minlength="4" required/>
    </div>
    <div>
        <label for="name">Nombre:</label>
        <input type="text" id="form-name" name="form-name" minlength="4" required/>
    </div>
    <div>
        <label for="name">Primer Apellido:</label>
        <input type="text" id="form-lastname1" name=form-lastname1" minlength="4" required/>
    </div>
    <div>
        <label for="name">Segundo Apellido:</label>
        <input type="text" id="form-lastname2" name="form-lastname2"minlength="4" required/>
    </div>
    <div>
        <label for="name">Primer Carrera:</label>
        <input type="text" id="form-lastname2" name="form-lastname2"minlength="4" required/>
    </div>
    <div>
        <label for="name">Segunda Carrera:</label>
        <input type="text" id="form-lastname2" name="form-lastname2"minlength="4"/>
    </div>
    <div>
        <label for="name">Sede:</label>
        <input type="text" id="form-lastname2" name="form-lastname2"minlength="4"/>
    </div>
    <div>
        <input type="submit" id="form-submit"/>
    </div>
    <div id="state"></div>
</form>


<script>
    $("#form-submit").click(function () {
        
        
        
        
        
    });
</script>
<?php
include_once '../public/footerIN.php';
