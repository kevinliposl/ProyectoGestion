<?php
include_once '../public/header.php';
?>

<table>
    <thead>
        <tr>
            <th>Universidad</th>
            <th id="form-th" style="display: none">Tipo de instalaci&oacute;n?</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <?php
                include '../business/UniversityBusiness.php';

                $universityBusiness = new UniversityBusiness();
                $currentUniversity = new University();
                $universities = $universityBusiness->selectAll();
                ?>

                <select id="form-university">
                    <option value="-1">Seleccione Universidad</option>
                    <?php
                    foreach ($universities as $currentUniversity) {
                        ?>
                        <option value="<?= $currentUniversity->getUniversityid(); ?>"><?= $currentUniversity->getUniversityName(); ?></option>
                        <?php
                    }
                    ?> 
                </select> 
            </td>
            <td>    
                <select id="form-headquarters-enclosure" style="display: none">
                    <option value="-1">
                        Seleccione un tipo
                    </option>
                    <option value="0">
                        Recinto
                    </option>
                    <option value="1">
                        Sede
                    </option>
                </select>
            </td>
        </tr>
    </tbody>
</table>


<table id="form-enclosure" style="display: none;">
    <thead>
        <tr>
            <th>Nombre</th>
        </tr>
    </thead>
    <form method="POST">
        <tr>
            <td>
                <input type="text" placeholder="Sede"/>
            </td>
            <td>
                <input type="submit" value="Insertar"/>
            </td>
        </tr>
    </form>
</table>

<table id="form-headquarters" style="display: none;">
    <thead>
        <tr>
            <th id="input-headquarters-text">Sede</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <form method="POST">
        <tr>
            <td>
                <select id="input-headquarters">
                    <option>
                        Selecccione una sede
                    </option>
                </select>
            </td>
            <td>
                <input type="text" placeholder="Recinto"/>
            </td>
            <td>
                <input type="submit" value="Insertar"/>
            </td>
        </tr>
    </form>
</table>

<script>
    $("#form-university").change(function () {
        if ($("#form-university").val() !== "-1") {
            var args = {
                "id": $("#form-university").val(),
                'select': 'select'
            };
            $.post('../business/UniversityBusiness.php', args, function (data) {
                if (data.universityhadheadquarter === "1") {
                    $("#form-enclosure").css('display', 'none');
                    $("#form-headquarters-enclosure").css("display", "block");
                    $("#form-th").css("display", 'block');
                } else {
                    $("#input-headquarters-text").css('display','none');
                    $("#input-headquarters").css('display','none');
                    $("#form-th").css("display", 'none');
                    $("#form-headquarters-enclosure").css("display", "none");
                    $("#form-enclosure").css('display', 'none');
                    $("#form-headquarters").css("display", "block");
                }
            }, "json").fail(function () {
                alert("La solicitud a fallado!!!");
            });
        } else {
            $("#form-enclosure").css('display', 'none');
            $("#form-th").css("display", 'none');
            $("#form-headquarters-enclosure").css("display", "none");
            $("#form-headquarters").css("display", "none");
        }
    });
    $("#form-headquarters-enclosure").change(function () {
        if ($("#form-headquarters-enclosure").val() === "1") {
            $("#form-headquarters").css("display", "none");

            $("#form-enclosure").css("display", "block");

        } else if ($("#form-headquarters-enclosure").val() === "0") {
            $("#form-enclosure").css("display", "none");
            $("#form-headquarters").css("display", "block");

        } else {
            $("#form-enclosure").css("display", "none");
            $("#form-headquarters").css("display", "none");
        }
    });

</script>

<?php
include_once '../public/footer.php';
