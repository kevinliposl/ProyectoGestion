<?php
include_once '../public/headerIN.php';
?>

<form method="POST" onsubmit="val(); return false" action="../business/StudentBusiness.php">
    <div>
        <label for="students">Correo*</label>
        <select id="form0">
        
        <?php
        include_once '../business/StudentBusiness.php';
   
        $studentBusiness = new StudentBusiness();
        $students = $studentBusiness->getAll();
        
        foreach ($students as $current) {
            echo '<form method="post" enctype="multipart/form-data" action="../business/bullAction.php">';
            echo '<input type="hidden" name="idBull" value="' . $current->getIdTBBull() . '">';
            echo '<tr>';
            echo '<input type="hidden" name="ranch" id="ranch" value="' . $current->getRanchTBBull() . '"/>';
            echo '<td><input type="text" name="code" id="code" value="' . $current->getCodeTBBull() . '"/></td>';
            echo '<td><input type="text" name="name" id="name" value="' . $current->getNameTBBull() . '"/></td>';
            echo '<td><input type="text" name="commercialcase" id="commercialcase" value="' . $current->getCommercialCaseTBBull() . '"/></td>';
            echo '<td><input type="date" name="buydate" id="buydate" value="' . $current->getBuyDateTBBull() . '"/></td>';
            echo '<td><input type="number" name="strawsquantity" id="sstrawsquantity" value="' . $current->getStrawsQuantityTBBull() . '"/></td>';
            echo '<td><input type="number" name="strawsprice" id="sstrawsprice" value="' . $current->getStrawsPriceTBBull() . '"/></td>';
            echo '<td><input type="submit" value="Actualizar" name="update" id="update"/></td>';
            echo '<td><input type="submit" value="Eliminar" name="delete" id="delete"/></td>';
            echo '</tr>';
            echo '</form>';
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
