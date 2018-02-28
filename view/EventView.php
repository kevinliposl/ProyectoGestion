<?php

include_once '../public/header.php';
include_once '../business/EventBusiness.php';
require_once '../util/SSession.php';

if (!isset(SSession::getInstance()->user)) {
    header('location: ../index.php');
}
?>

<?php

echo "<h3>Eventos</h3>";

$eventBusiness = new EventBusiness();
$event = $eventBusiness->selectAllTotal();
?>

<table>
    <tr>
        <th>Busqueda General</th>
        <th>Fecha</th>
        <th>Lugar</th>
        <th>Hora</th>
    </tr>
    <tr>
        <td>
            <input type ='text' id="searchGeneral" placeholder="Busqueda General"/>
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
            <input type="button" id="search" value="Buscar"/> 
        </td>
        <td>
        </td>
    </tr>
</table>

<script>
    $("#search").click(function () {
        var args = {
            'searchGeneral': $('#searchGeneral').val().trim(),
            'searchDate': $('#searchDate').val(),
            'searchPlace': $('#searchPlace').val().trim(),
            'searchHour': $('#searchHour').val(),
            'selectEvent': 'selectEvent'
        };
        $('#message').text('Espere...');
        $.post('../business/SearchBusiness.php', args, function (data) {
            $.each(data, function (i, item) {
                $('#message').html("<li><a href='CommentView.php?id=" + item.activityid + "&title=" + item.activitytitle + "&des="+ item.activitydescription + "'><div> Fecha de creacion: "
                        + item.activitycreateddate + ", Fecha de actualizacion: " + item.activityupdatedate + ", Numero de seguidores: " + item.activitylikecount + ", Cantidad de comentarios: " +
                        item.activitycommentcount + ", Titulo: " + item.activitytitle + ", Descripcion: " + item.activitydescription + "</div></a></li>");
            });
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
<br>
<br>
<?php
echo "<h3>Lista de todos los Eventos</h3>";
echo '<br>';
echo "<a href='EventViewDay.php'><font color=red>Eventos de Hoy</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href='EventViewWeek.php'><font color=red>Eventos de la Semana</font></a>&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href='EventViewMonth.php'><font color=red>Eventos del Mes</font></a>";

foreach ($event as $event) {
    $size = $event['activitycommentcount'] + 1;

    $fechaEvent = $event['eventdate'];
    $dayafther = $event['eventdayafter']; //despues
    $daybefore = $event['eventdaybefore']; //antes

    $fecha = date('Y-m-j');

    $fechaAntesSemana = strtotime('-' . $daybefore . ' day', strtotime($fecha));
    $nuevaAs = date('Y-m-j', $fechaAntesSemana);

    $fechadespuesSemana = strtotime('+' . $daybefore . ' day', strtotime($fecha));
    $nuevaDs = date('Y-m-j', $fechadespuesSemana);

    if (($fecha >= $nuevaAs) && ($fecha <= $nuevaDs)) {
        echo "<li><a href='CommentView.php?id=" . $event['activityid'] . "&title=" . $event['activitytitle'] . "&des= " . $event['activitydescription'] . "'><div> Fecha de creacion: " . $event['activitycreateddate'] . ", Fecha de actualizacion: " . $event['activityupdatedate'] . ", Numero de seguidores: " . $event['activitylikecount'] . ", Cantidad de comentarios: " . $event['activitycommentcount'] . ", Titulo: " . $event['activitytitle'] . ", Descripcion: " . $event['activitydescription'] . ", Lugar: " . $event['eventplace'] . ", Dia: " . $event['eventdate'] . ", Hora: " . $event['eventhour'] . "</div></a>";
        echo "</li>";
    }
}//End foreach ($events as $event) 
//    echo "</form>";
?>

<?php

include_once '../public/footer.php';
?>   