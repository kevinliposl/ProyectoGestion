<?php
include_once '../public/header.php';
RandomPassGenerator::getInstance();

include_once '../business/CareerBusiness.php';
$careerBusiness = new CareerBusiness();

include_once '../business/UniversityBusiness.php';
$universityBusiness = new UniversityBusiness();
?>

<table>
    <tr>
        <th>Mail</th>
        <th>Nombre</th>
        <th>Primer Apellido</th>
        <th>Segundo Apellido</th>
        <th>*</th>
        <th id="thactorcareer1" style="display: none">Carrera</th>
        <th id="thactorarea" style="display: none">Area</th>
    </tr>
    <form enctype="multipart/form-data" onsubmit="validate(); return false">
        <tr>
            <td>
                <input type="email" id="actormail" name="actormail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"/>
            </td>
            <td>
                <input type="text" id="actorname" name="actorname" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <input type="text" id="actorlastname1" name="actorlastname1" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <input type="text" id="actorlastname2" name="actorlastname2" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <select id="actortype" name="actortype" style="width: 100%;">
                    <option value="invalidate">Seleccione un tipo</option>
                    <option value="Student">Estudiante</option>
                    <option value="Professor">Profesor</option>
                    <option value="Administrative">Administrativo</option>
                </select>
            </td>
            <td id="tdactorcareer1" style="display: none;">
                <select id="actorcareer1" name="actorcareer1" style="width: 100%">
                    <option value="0">Ninguna</option>
                           <?php
                    $universities = $universityBusiness->selectAll();
                    $careers = $careerBusiness->selectAllByUniversity();
                    foreach ($universities as $university) {
                        $universityname = $university['universityname'];
                        ?>
                        <optgroup label="<?= $universityname; ?>">
                            <?php
                            foreach ($careers as $career) {
                                if ($career['universityname'] == $universityname) {
                                    ?>
                                    <option value=" <?= $career['careerid']; ?> "> <?= $career['careerid'] . " | " . $career['careername'] . " | " . $career['enclosurename']; ?> </option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    
                </select>
            </td>
            <td id="tdactorarea" style="display: none;">
                <input id="actorarea" name="actorarea" />
            </td>
            <td>
                <input type="submit" name="create" value="Registrar"/> 
            </td>
        </tr>
    </form>
    <script>
        function validate() {
            if ($('#actortype').val() !== 'invalidate') {
                var url = '../business/' + $('#actortype').val() + 'Business.php';
                var args = {
                    'actormail': $('#actormail').val().trim(),
                    'actorname': $('#actorname').val().trim(),
                    'actorlastname1': $('#actorlastname1').val().trim(),
                    'actorlastname2': $('#actorlastname2').val().trim(),
                    'actorcareer1': $('#actorcareer1').val().trim(),
                    'actorarea': $('#actorarea').val().trim(),
                    'create': 'create'
                };

                $.post(url, args, function (data) {
                    if (data.result === 1) {
                        $("#state").html(message["success"]);
                    } else if (data.result === -1) {
                        $("#state").html(message["format"]);
                    } else if (data.result === -2) {
                        $("#state").html(message["emptyField"]);
                    } else {
                        $("#state").html(message["fail"]);
                    }
                }, 'json').fail(function () {
                    alert('Error de Envio');
                });
            } else {
                alert('Seleccione un tipo');
            }
        }


        $('#actortype').change(function () {
            hiddenAll();
            if ($('#actortype').val() === 'Student') {
                showStudent();
            } else if ($('#actortype').val() === 'Administrative') {
                showAdministrative();
            }
        });

        function hiddenAll() {
            $('#tdactorarea').css('display', 'none');
            $('#tdactorcareer1').css('display', 'none');
            $('#thactorarea').css('display', 'none');
            $('#thactorcareer1').css('display', 'none');
        }

        function showStudent() {
            $('#thactorcareer1').css('display', 'inline-block');
            $('#tdactorcareer1').css('display', 'inline-block');
        }

        function showAdministrative() {
            $('#thactorarea').css('display', 'inline-block');
            $('#tdactorarea').css('display', 'inline-block');
        }
    </script>

    <tr>
        <td></td>
        <td>
            <div id="state"></div>
        </td>
    </tr>

    <?php
    include_once '../public/footer.php';
    ?>
