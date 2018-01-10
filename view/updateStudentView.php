<?php
include_once 'public/header.php';
?>


<h1>Update</h1>

<form onsubmit="val(); return false">
    
    <div>
        <label for="students">Estudiante*</label>
        <select id="form-students">
           <?php       
                if (isset($students)) {
                    while($item = $vars->fetch()){
            ?>
                        <option  value="<?= $student->getId(); ?>"><?= $student ?></option>
            <?php 
                    }
                }
            ?>
        </select>
    </div>
    <div>
        <label for="name">Nombre*</label>
        <input type="text" id="form-name" pattern="[a-zA-Z\s]+$" minlength="4" required/>
    </div>
    <br>
    <div>
        <label for="lastname1">Primer Apellido*</label>
        <input type="text" id="form-lastname1" pattern="[a-zA-Z\s]+$" minlength="4" required/>
    </div>
    <br>
    <div>
        <label for="lastname2">Segundo Apellido*</label>
        <input type="text" id="form-lastname2" pattern="[a-zA-Z\s]+$" minlength="4" required/>
    </div>
    <br>
    <div>
        <label for="password">Contrase&ncaron;a*</label>
        <input type="password" id="form-password" minlength="8" required/>
    </div>
    <br>
    <div>
        <label for="career1">Primer Carrera*</label>
        <input type="text" id="form-career1" minlength="4" required/>
    </div>
    <br>
    <div>
        <label for="career2">Segunda Carrera</label>
        <input type="text" id="form-career2" minlength="4"/>
    </div>
    <br>
    <div>
        <label for="headquarters">Sede*</label>
        <input type="text" id="form-headquarters" minlength="4" required/>
    </div>
    <br>
    <div>
        <input type="submit" id="form-submit"/>
    </div>
    <br>
    <br>
    <div id="state"></div>
</form>

<script type="text/javascript" async>
    function val() {

        if ($("#form-students").val() === '-1') {
            $("#state").text("Seleccione un estudiante...");
            return false;
        }
        var args = {
            "id": $("#form-students").val()
        };

        $("#state").text("Espere...");

        $.post('?controller=Student&action=update', args, function (data) {
            if (data.result) {
                $("#form-name").text(data.studentname);
                $("#form-lastname1").text(data.studentlastname1);
                $("#form-lastname2").text(data.studentlastname2);
                $("#form-password").text(data.studentpassword);
                $("#form-career1").text(data.studentcareer1);
                $("#form-career2").text(data.studentcareer2);
                $("#form-headquarters").text(data.studentheadquarters);
            } else {
                $("#state").text("Error en la petici&oacuten");
            }
        }, 'json');
    }
</script>
<?php
include_once 'public/footer.php';
