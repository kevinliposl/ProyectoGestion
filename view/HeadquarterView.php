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
                <select id="form-select-headquarters-enclosure" style="display: none">
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
            <th>Sede</th>
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

<table id="form-only-enclosure" style="display: none;">
    <thead>
        <tr>
            <th>Nombre</th>
        </tr>
    </thead>
    <form method="POST" onsubmit="submitOnlyEnclosure(); return false;">
        <tr>
            <td>
                <input id="form-only-enclosure-name"type="text" placeholder="Recinto" required/>
            </td>
            <td>
                <input type="submit" value="Insertar"/>
            </td>
        </tr>
    </form>
</table>


<script>

    function submitOnlyEnclosure() {
        if ($("#form-only-enclosure-name").val() !== "-1") {
            var args = {
                "universityid": $("#form-university").val(),
                "name": $("#form-only-enclosure-name").val(),
                "create": "create",
                "action": "only"
            };

            $.post('../business/EnclosureBusiness.php', args, function (data) {
                if (data.result === "1") {


                } else {

                }
            }, "json").fail(function () {
                alert("La solicitud a fallado!!!");
            });
        } else {
            alert("Solicitud no permitida!!!");
        }
    }

    function showHeadquarterAndEnclosure() {
        $("#form-th").css("display", 'block');
        $("#form-select-headquarters-enclosure").css("display", "block");
    }

    function showOnlyEnclosure() {
        $("#form-only-enclosure").css("display", 'block');
    }

    $("#form-university").change(function () {
        if ($("#form-university").val() !== "-1") {
            var args = {
                "id": $("#form-university").val(),
                'select': 'select'
            };
            $.post('../business/UniversityBusiness.php', args, function (data) {
                if (data.universityhadheadquarter === "1") {
                    hideAll();
                    showHeadquarterAndEnclosure();
                } else {
                    hideAll();
                    showOnlyEnclosure();
                }
            }, "json").fail(function () {
                alert("La solicitud a fallado!!!");
            });
        } else {
            hideAll();
        }
    });

    $("#form-select-headquarters-enclosure").change(function () {
        if ($("#form-select-headquarters-enclosure").val() === "1") {
            $("#form-headquarters").css("display", "none");
            $("#form-enclosure").css("display", "block");

        } else if ($("#form-select-headquarters-enclosure").val() === "0") {
            $("#form-enclosure").css("display", "none");
            $("#form-headquarters").css("display", "block");
        } else {
            hideAll();
        }
    });

    function hideAll() {
        hideSelectHeadquartersEnclosure();
        hideFormEnclosure();
        hideFormHeadquarters();
        hideFormOnlyEnclosure();
    }

    function hideFormHeadquarters() {
        $("#form-headquarters").css("display", "none");
    }

    function hideFormEnclosure() {
        $("#form-enclosure").css("display", "none");
    }

    function hideFormOnlyEnclosure() {
        $("#form-only-enclosure").css("display", "none");
    }

    function hideSelectHeadquartersEnclosure() {
        $("#form-th").css("display", 'none');
        $("#form-select-headquarters-enclosure").css("display", "none");
    }

</script>

<?php
include_once '../public/footer.php';
