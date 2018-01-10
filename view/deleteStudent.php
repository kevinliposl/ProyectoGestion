<?php
include_once '../public/headerIN.php';
?>

<form method="POST" onsubmit="val(); return false" action="../business/StudentBusiness.php">
    <div>
        <label for="students">Estudiante*</label>
        <select id="form-students">
            <?php
            include_once '../business/StudentBusiness.php';

            $studentBusiness = new StudentBusiness();
            $students = $studentBusiness->getAll();

            foreach ($students as $student) {
                ?>
                <option id="<?= $student->__get('id'); ?>" value=""><?= $student ?></option>
            <?php } ?>
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
