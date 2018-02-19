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
        <th>Primer Carrera</th>
        <th>Segunda Carrera</th>
    </tr>
    <form enctype="multipart/form-data" method='POST' action='../business/ActorBusiness.php'>
        <!--<form enctype="multipart/form-data" onsubmit="validate(); return false">-->
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
            <td id="tactortype">
                <select id="actortype" name="actortype" style="width: 100%;">
                    <option value="Student">Estudiante</option>
                    <option value="Professor">Profesor</option>
                    <option value="Administrative">Administrativo</option>
                </select>
            </td>
            <td>
                <select name="studentcareer1" style="width: 100%">
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
            <td>
                <select name="studentcareer2" style="width: 100%">
                    <option value="0">Ninguna</option>
                    <?php
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
            <td>
                <input type="submit" name="create" value="Registrar"/> 
            </td>
        </tr>
    </form>
    <script>
        function validate() {

            var args = {};
            var url = '../business/' + $('#actortype').val() + 'Business.php';
            alert(url);
//            $.post(url, args, function (data) {
//
//
//            }, 'json').fail(function () {
//
//
//            });
        }
    </script>

    <tr>
        <td></td>
        <td>
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "empty") {
                    echo '<p style = "color: red">Campo(s) vacio(s)</p>';
                } else if ($_GET['error'] == "format") {
                    echo '<p style = "color: red">Error, formato de numero</p>';
                } else if ($_GET['error'] == "dbError") {
                    echo '<center><p style = "color: red">Error al procesar la transacción</p></center>';
                }
            } else if (isset($_GET['success'])) {
                echo '<p style = "color: green">Transacción realizada</p>';
            }
            ?>
        </td>
    </tr>

    <?php
    include_once '../public/footer.php';
    ?>
