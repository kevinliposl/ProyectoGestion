<?php
include_once 'public/header.php';
?>

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
