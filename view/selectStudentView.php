<?php
include_once 'public/header.php';
?>

<form onsubmit="val(); return false">
    <div>
        <label for="students">Estudiante*</label>
        <select id="form-students">
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

        $.post('?controller=Student&action=select', args, function (data) {
            $("#state").text(JSON.stringify(data));
            if (data.studentname) {
                $("#state").text(data.studentname + " | " + data.studentlastname1 + " | " + data.studentlastname2 + " | " + data.studentcareer1 + " | " + data.studentcareer2 + " | " + data.studentheadquarters);
            } else {
                $("#state").text("Error en la petici&oacuten");
            }
        }, 'json');
    }
</script>

<?php
include_once 'public/footer.php';
