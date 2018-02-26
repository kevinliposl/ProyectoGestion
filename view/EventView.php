<?php

include_once '../public/header.php';

include_once '../business/EventBusiness.php';

require_once '../util/SSession.php';

if (!isset(SSession::getInstance()->user)) {
    header('location: ../index.php');
}
?>

<?php

$eventBusiness = new EventBusiness();
$event = $eventBusiness->selectAllTotal();

//    echo "<form enctype='multipart/form-data' method='POST' action='../business/EventBusiness.php'>";
echo "<h3>Lista de todos los Eventos</h3>";
echo "<a href='EventViewDay.php'><font color=red>Eventos de Hoy</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href='EventViewWeek.php'><font color=red>Eventos de la Semana</font></a>&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href='EventViewMonth.php'><font color=red>Eventos del Mes</font></a>";

foreach ($event as $event) {
    $size = $event['commentcount'] + 1;

    $fechaEvent = $event['eventdate'];
    $dayafther = $event['dayafter']; //despues
    $daybefore = $event['daybefore']; //antes

    $fecha = date('Y-m-j');

    $fechaAntesSemana = strtotime('-' . $daybefore . ' day', strtotime($fecha));
    $nuevaAs = date('Y-m-j', $fechaAntesSemana);

    $fechadespuesSemana = strtotime('+' . $daybefore . ' day', strtotime($fecha));
    $nuevaDs = date('Y-m-j', $fechadespuesSemana);

    if (($fecha >= $nuevaAs) && ($fecha <= $nuevaDs)) {
        echo "<li><a href='CommentView.php?id=" . $event['activityid'] . "&title=" . $event['activitytitle'] . "&des= " . $event['activitydescription'] . "'><div> Fecha de creacion: " . $event['createddate'] . ", Fecha de actualizacion: " . $event['updatedate'] . ", Numero de seguidores: " . $event['likecount'] . ", Cantidad de comentarios: " . $event['commentcount'] . ", Titulo: " . $event['activitytitle'] . ", Descripcion: " . $event['activitydescription'] . ", Lugar: " . $event['eventplace'] . ", Dia: " . $event['eventdate'] . ", Hora: " . $event['eventhour'] . "</div></a>";
        echo "</li>";
    }
}//End foreach ($events as $event) 
//    echo "</form>";
?>

<?php

include_once '../public/footer.php';
?>   