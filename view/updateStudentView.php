<?php
include_once 'public/header.php';
?>


<h1>Update</h1>

<form onsubmit="val(); return false">

    <div>
        <label for="students">Estudiante*</label>
        <select id="form-students">
            <option value="-1">Seleccione Estudiante</option>
            <?php
            if (isset($vars)) {
                foreach ($vars as $student) {
                    ?>
                    <option  value="<?= $student['studentid'] ?>"><?= $student['studentname'] . " | " . $student['studentlastname1'] ?></option>
                    <?php
                }
            }
            ?>
        </select>
    </div>
    <br>
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
        <input type="text" id="form-career2" minlength="4" />
    </div>
    <br>
    <div>
        <label for="headquarters">Sede*</label>
        <input type="text" id="form-headquarters" minlength="4" required/>
    </div>
    <br>
    <div>
        <input type="submit" id="form-submit" value="Actualizar"/>
    </div>
    <br>
    <br>
    <div id="state"></div>
</form>

<script type="text/javascript" async>

    $("#form-students").change(function () {
        if ($("#form-students").val() === '-1') {
            $("#form-name").val("");
            $("#form-lastname1").val("");
            $("#form-lastname2").val("");
            $("#form-password").val("");
            $("#form-career1").val("");
            $("#form-career2").val("");
            $("#form-headquarters").val("");
            $("#state").text("Seleccione un estudiante...");
            return false;
        }

        var args = {
            "id": $("#form-students").val()
        };

        $("#state").text("Espere...");

        $.post('?controller=Student&action=select', args, function (data) {
            if (data.studentname) {
                $("#form-name").val(data.studentname);
                $("#form-lastname1").val(data.studentlastname1);
                $("#form-lastname2").val(data.studentlastname2);
                $("#form-password").val(data.studentpassword);
                $("#form-career1").val(data.studentcareer1);
                $("#form-career2").val(data.studentcareer2);
                $("#form-headquarters").val(data.studentheadquarters);
                $("#state").text("");
            } else {
                $("#state").text("Error en la petici&oacuten");
            }
        }, 'json');
    });

    function val() {
        if ($("#form-students").val() === '-1') {
            $("#state").text("Seleccione un estudiante...");
            return false;
        }

        var args = {
            "id": $("#form-students").val().trim(),
            "name": $("#form-name").val().trim(),
            "lastname1": $("#form-lastname1").val().trim(),
            "lastname2": $("#form-lastname2").val().trim(),
            "password": $("#form-password").val().trim(),
            "career1": $("#form-career1").val().trim(),
            "career2": $("#form-career2").val().trim(),
            "headquarters": $("#form-headquarters").val().trim()
        };

        $("#state").text("Espere...");

        $.post('?controller=Student&action=update', args, function (data) {
            if (data.result === "1") {
                $("#state").text("Actualizado");
            } else {
                $("#state").text("Error en la petici&oacuten");
            }
        }, 'json');
    }
</script>
<?php
include_once 'public/footer.php';
