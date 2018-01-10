<?php
include_once 'public/header.php';
?>

<form onsubmit="val(); return false">
    <div>
        <label for="students">Estudiante*</label>
        <select id="form-students">
            <?php
            include_once '../domain/Student.php';
            include_once '../business/StudentBusiness.php';

            $studentBusiness = new StudentBusiness();
            $students = $studentBusiness->getAll();
            if (isset($students)) {
                foreach ($students as $student) {
                    ?>
                    <option  value="<?= $student->getId(); ?>"><?= $student ?></option>
                <?php }
            } ?>
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
