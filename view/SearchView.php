<?php

include_once '../public/header.php';

require_once '../util/SSession.php';

if (!isset(SSession::getInstance()->user)) {
    header('location: ../index.php');
}
?>

<table>
    <tr>
        <th>Busqueda General</th>
        <th>Fecha</th>
        <th>Tipo de Actividad</th>
        <th>Lugar</th>
        <th>Hora</th>
        <th>Actor</th>
    </tr>
    <tr>
        <td>
            <input type ='text' id="searchGeneral" placeholder="Busqueda General"/>
        </td>
        <td>
            <select id="typeActivity"style="width: 100%;">
                <option value="event">Evento</option>
                <option value="post">Publicaci&oacute;n</option>
            </select>
        </td>
        <td>
            <input type ='date' id="searchDate" placeholder="Fecha"/>
        </td>
        <td>
            <input type="text" id="searchPlace" placeholder="Lugar">
        </td>
        <td>
            <input type="time" id="searchHour" placeholder="Hora">
        </td>
        <td>
            <input type="text" id="searchActor" placeholder="Actor">
        </td>
        <td>
            <input type="button" id="search" value="Buscar"/> 
        </td>
        <td>
        </td>
    </tr>
</table>
<script>
    $("#search").click(function () {
        var args = {
            'typeActivity': $('#typeActivity').val().trim(),
            'searchGeneral': $('#searchGeneral').val().trim(),
            'searchDate': $('#searchDate').val(),
            'searchHour': $('#searchHour').val(),
            'searchPlace': $('#searchPlace').val().trim(),
            'searchActor': $('#searchActor').val().trim(),
            'select': 'select'
        };
        $('#message').text('Espere...');

        $.post('../business/SearchBusiness.php', args, function (data) {
            $('#message').text(JSON.stringify(data.result));
        }, 'json').fail(function () {
            alert('Error al acceder al servidor');
        });
    });
</script>
<tr>
    <td></td>
    <td>
        <div id="message"></div>
    </td>
</tr>

<?php

include_once '../public/footer.php';
