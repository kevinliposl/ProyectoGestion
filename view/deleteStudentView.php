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
                    <option  value="<?= $student['studentid'] ?>"><?= $student['studentname'].' | '.$student['studentlastname1'].' | '.$student['studentlastname2'] ?></option>
                <?php }
            } ?>
        </select>
    </div>
    <br>
    <div>
        <input type="submit" id="form-submit" value="Eliminar"/>
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
            "id": $("#form-students").val(),
            "delete": "delete"
        };

        $("#state").text("Espere...");

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
include_once 'public/footer.php';
