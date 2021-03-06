<?php
include_once '../public/header.php';
require_once '../util/SSession.php';

if (!isset(SSession::getInstance()->user)) {
    header('location: ../index.php');
}
?>
<table>
    <thead>
        <tr>
            <th>Universidad</th>
            <th id = "form-th" style = "display: none">Tipo de instalaci & oacute;
                n?</th>
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
                        <option value="<?= $currentUniversity['universityid']; ?>"><?= $currentUniversity['universityname']; ?></option>
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
</br>

<table id="form-enclosure" style="display: none;">
    <form method="POST" onsubmit="submitHeadquarter(); return false">
        <tr>
            <td>
                <input id="form-name-headquarter"type="text" placeholder="Sede"/>
            </td>
            <td>
                <input type="submit" value="Registrar"/>
            </td>
        </tr>
    </form>
</table>

<table id="form-headquarters" style="display: none;">
    <form method="POST" onsubmit="submitHeadquarterEnclosure(); return false">
        <tr>
            <td>
                <select id="input-headquarters">
                </select>
            </td>
            <td>
                <input id="form-headquarters-enclosure-name" type="text" placeholder="Recinto"/>
            </td>
            <td>
                <input type="submit" value="Registrar"/>
            </td>
        </tr>
    </form>
</table>

<table id="form-only-enclosure" style="display: none;">
    <form method="POST" onsubmit="submitOnlyEnclosure(); return false">
        <tr>
            <td>
                <input id="form-only-enclosure-name"type="text" placeholder="Recinto" required/>
            </td>
            <td>
                <input type="submit" value="Registrar"/>
            </td>
        </tr>
    </form>
</table>
<div id="state"></div>

<script>

    function submitOnlyEnclosure() {
        var args = {
            "universityid": $("#form-university").val(),
            "name": $("#form-only-enclosure-name").val(),
            "create": "create",
            "action": "only"
        };
        $.post('../business/EnclosureBusiness.php', args, function (data) {
            if (data.result === 1) {
                $("#state").html(message["success"]);
            } else if (data.result === -1) {
                $("#state").html(message["format"]);
            } else if (data.result === -2) {
                $("#state").html(message["fail"]);
            } else {
                $("#state").html(message["emptyField"]);
            }
        }, "json").fail(function () {
            alert("La solicitud a fallado!!!");
        });
    }

    function submitHeadquarterEnclosure() {
        var args = {
            "universityid": $("#form-university").val(),
            "headquarterid": $('#input-headquarters').val(),
            "enclosurename": $("#form-headquarters-enclosure-name").val(),
            "create": "create",
            "action": ""
        };

        $.post('../business/EnclosureBusiness.php', args, function (data) {
            if (data.result === 1) {
                $("#state").html(message['success']);
            } else if (data.result === 0) {
                $("#state").html(message["fail"]);
            } else if (data.result === -1) {
                $("#state").html(message["format"]);
            } else {
                $("#state").html(message["emptyField"]);
            }
        }, "json").fail(function (jqXHR, textStatus, errorThrown) {
            alert("La solicitud a fallado!!!");
        });
    }

    function submitHeadquarter() {
        var args = {
            "headquarteruniversityid": $("#form-university").val(),
            "headquartername": $("#form-name-headquarter").val(),
            "create": "create"
        };

        $.post('../business/HeadquarterBusiness.php', args, function (data) {
            if (data.result === 1) {
                $("#state").html(message["success"]);
            } else if (data.result === -1) {
                $("#state").html(message["format"]);
            } else if (data.result === -2) {
                $("#state").html(message["fail"]);
            } else {
                $("#state").html(message["emptyField"]);
            }
        }, "json").fail(function () {
            alert("La solicitud a fallado!!!");
        });
    }

    $("#form-select-headquarters-enclosure").change(function () {
        if ($("#form-select-headquarters-enclosure").val() === "1") {
            $("#form-headquarters").css("display", "none");
            $("#form-enclosure").css("display", "block");

        } else if ($("#form-select-headquarters-enclosure").val() === "0") {
            var args = {
                "universityid": $("#form-university").val(),
                "select": "select"
            };

            $.post('../business/HeadquarterBusiness.php', args, function (data) {
                if (data[0].headquarterid) {
                    $('#input-headquarters').empty();
                    $('#input-headquarters').append($("<option></option>").attr("value", "-1").text(" Seleccione una Sede "));

                    $.each(data, function (key, value) {
                        $('#input-headquarters').append($("<option></option>").attr("value", value.headquarterid).text(value.headquartername));
                    });

                } else if (data.result === -1) {
                    $("#state").html(message["format"]);
                } else if (data.result === -2) {
                    $("#state").html(message["fail"]);
                } else {
                    $("#state").html(message["emptyField"]);
                }
            }, "json").fail(function () {
                alert("La solicitud a fallado!!!");
            });
            $("#form-enclosure").css("display", "none");
            $("#form-headquarters").css("display", "block");
        } else {
            hideAll();
        }
    });

    function showHeadquarterAndEnclosure() {
        $("#form-th").css("display", 'block');
        $("#form-select-headquarters-enclosure").css("display", "block");
    }

    function showOnlyEnclosure() {
        $("#form-only-enclosure").css("display", 'block');
    }

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

</script>

<?php
echo "<h2>Sedes</h2>";
include_once '../business/HeadquarterBusiness.php';

$headquarterBusiness = new HeadquarterBusiness;
$headquarters = $headquarterBusiness->selectAll();

echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<th>Universidad</th>";
echo "<th>Sede</th>";
echo "</tr>";
echo "</thead>";
foreach ($headquarters as $headquarter) {

    echo "<form enctype='multipart/form-data' method='POST' action='../business/HeadquarterBusiness.php'>";
    echo "<tr>";
    echo "<td>";
    echo "<input type ='text' disabled value='" . $headquarter['universityname'] . "'/>";
    echo "</td>";
    echo "<td>";
    echo "<input type ='text' name='headquartername' value='" . $headquarter['headquartername'] . "'/>";
    echo "</td>";
    echo "<td>";
    echo "<input type ='hidden' name='headquarterid' value='" . $headquarter['headquarterid'] . "'/>";
    echo "</td>";
    echo "<td>";
    echo "<input type ='submit' name='update' value='Actualizar'/>";
    echo "</td>";
    echo "</tr>";
    echo "</form>";
}
echo "</table>"
?>

<?php
echo "<h2>Recintos</h2>";
include_once '../business/EnclosureBusiness.php';

$enclosureBusiness = new EnclosureBusiness;
$enclosures = $enclosureBusiness->selectAll();

echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<th>Universidad</th>";
echo "<th>Nombre</th>";
echo "</tr>";
echo "</thead>";
foreach ($enclosures as $enclosure) {

    echo "<form enctype='multipart/form-data' method='POST' action='../business/EnclosureBusiness.php'>";
    echo "<tr>";
    echo "<td>";
    echo "<input type ='text' value='" . $enclosure['universityname'] . "' disabled/>";
    echo "</td>";
    echo "<td>";
    echo "<input type ='hidden' name='enclosureid' value='" . $enclosure['enclosureid'] . "'/>";
    echo "<input type ='text' name='enclosurename' value='" . $enclosure['enclosurename'] . "'/>";
    echo "</td>";
    echo "<td>";
    echo "<input type ='submit' name='delete' value='Eliminar'/>";
    echo "</td>";
    echo "<td>";
    echo "<input type ='submit' name='update' value='Actualizar'/>";
    echo "</td>";
    echo "</tr>";
    echo "</form>";
}
echo "</table>"
?>

<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == "empty") {
        echo '<p style="color: red">Campo(s) vacio(s)</p>';
    } else if ($_GET['error'] == "format") {
        echo '<p style="color: red">Error, formato de numero</p>';
    } else if ($_GET['error'] == "dbError") {
        echo '<center><p style="color: red">Error al procesar la transacción</p></center>';
    }
} else if (isset($_GET['success'])) {
    echo '<p style="color: green">Transacción realizada</p>';
}
?>
<?php
include_once '../public/footer.php';
