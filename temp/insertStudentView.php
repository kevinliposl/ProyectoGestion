<?php
include_once 'public/header.php';
?>

<form id="new" onsubmit="val(this); return false">
    <div>
        <label for="name">Nombre*</label>
        <input type="text" id="form-name" name="name" pattern="[a-zA-Z\s]+$"/>
    </div>
    <br>
    <div>
        <label for="lastname1">Primer Apellido*</label>
        <input type="text" id="form-lastname1" name="lastname1" pattern="[a-zA-Z\s]+$"/>
    </div>
    <br>
    <div>
        <label for="lastname2">Segundo Apellido*</label>
        <input type="text" id="form-lastname2" name="lastname2" pattern="[a-zA-Z\s]+$"/>
    </div>
    <br>
    <div>
        <label for="password">Contrase&ncaron;a*</label>
        <input type="password" id="form-password" name="password"/>
    </div>
    <br>
    <div>
        <label for="career1">Primer Carrera*</label>
        <input type="text" id="form-career1" name="career1"/>
    </div>
    <br>
    <div>
        <label for="career2">Segunda Carrera</label>
        <input type="text" id="form-career2" name="career2"/>
    </div>
    <br>
    <div>
        <label for="headquarters">Sede*</label>
        <input type="text" id="form-headquarters" name="headquarters"/>
    </div>
    <br>
    <div>
        <input type="submit" id="form-submit" value="Crear"/>
    </div>
    <br>
    <br>
    <div id="state"></div>
</form>







<script type="text/javascript">
    
        function val(form) {

        var args = {
            "name": form.name.value,
            "lastname1": form.lastname1.value,
            "lastname2": form.lastname2.value,
            "password": form.password.value,
            "career1": form.career1.value,
            "career2": form.career2.value,
            "headquarters": form.headquarters.value
        };
        
        alert(JSON.stringify(args));
//        $.ajax({
//            data: args,
//            type: "POST",
//            dataType: "json",
//            url: '?controller=Student&action=insert'
//        }).done(function (data) {
//            if (data.result === 1) {
//                $("#state").html(message["success"]);
//            } else if (data.result === -1) {
//                $("#state").html(message["format"]);
//            } else if (data.result === -2) {
//                $("#state").html(message["fail"]);
//            } else {
//                $("#state").html(message["emptyField"]);
//            }
//        }).fail(function () {
//            alert(global["fail"]);
//        });
    }
    
    
    
    
    
    
    

    function val(form) {

        var args = {
            "name": form.name.value,
            "lastname1": form.lastname1.value,
            "lastname2": form.lastname2.value,
            "password": form.password.value,
            "career1": form.career1.value,
            "career2": form.career2.value,
            "headquarters": form.headquarters.value,
        };
        
        alert(JSON.stringify(args));
//        $.ajax({
//            data: args,
//            type: "POST",
//            dataType: "json",
//            url: '?controller=Student&action=insert'
//        }).done(function (data) {
//            if (data.result === 1) {
//                $("#state").html(message["success"]);
//            } else if (data.result === -1) {
//                $("#state").html(message["format"]);
//            } else if (data.result === -2) {
//                $("#state").html(message["fail"]);
//            } else {
//                $("#state").html(message["emptyField"]);
//            }
//        }).fail(function () {
//            alert(global["fail"]);
//        });
    }
</script>

<?php
include_once 'public/footer.php';
