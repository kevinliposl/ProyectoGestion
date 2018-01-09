<?php
include_once '../public/headerIN.php';
?>

<form method="POST" onsubmit="val(); return false" action="../business/StudentBusiness.php">
    <div>
        <label for="mail">Correo*</label>
        <input type="email" id="form-mail" name="form-mail" minlength="4" required/>
    </div>
    <div>
        <label for="name">Nombre*</label>
        <input type="text" id="form-name" name="form-name" minlength="4" required/>
    </div>
    <div>
        <label for="lastname1">Primer Apellido*</label>
        <input type="text" id="form-lastname1" name=form-lastname1" minlength="4" required/>
    </div>
    <div>
        <label for="lastname2">Segundo Apellido*</label>
        <input type="text" id="form-lastname2" name="form-lastname2" minlength="4" required/>
    </div>
    <div>
        <label for="career1">Primer Carrera*</label>
        <input type="text" id="form-career1" name="form-career1" minlength="4" required/>
    </div>
    <div>
        <label for="career2">Segunda Carrera</label>
        <input type="text" id="form-career2" name="form-career2" minlength="4"/>
    </div>
    <div>
        <label for="headquarters">Sede*</label>
        <input type="text" id="form-headquarters" name="form-headquarters" minlength="4" required/>
    </div>
    <div>
        <input type="submit" id="form-submit"/>
    </div>
    <br>
    <br>
    <div id="state"></div>
</form>
<script type="text/javascript" async>
    function val() {
        var args = {
            "mail": $("#form-mail").val().trim(),
            "name": $("#form-name").val().trim(),
            "lastname1": $("#form-lastname1").val().trim(),
            "lastname2": $("#form-lastname2").val().trim(),
            "career1": $("#form-career1").val().trim(),
            "career2": $("#form-career2").val().trim(),
            "headquarters": $("#form-headquarters").val().trim(),
            "create": "create"
        };

        $.post('../business/StudentBusiness.php', args, function (data) {
            if (data.result) {
                $("#state").text(data.result);
            } else {
                $("#state").text("Error en la petici&oacuten");
            }
        }, 'json');
    }
</script>
<?php
include_once '../public/footerIN.php';
