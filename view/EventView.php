<?php
include_once '../public/header.php';

include_once '../business/EventBusiness.php';
?>

<?php
    $eventBusiness = new EventBusiness();
    $event = $eventBusiness->selectAllTotal();

//    echo "<form enctype='multipart/form-data' method='POST' action='../business/EventBusiness.php'>";
    echo "<h3>Lista de Eventos</h3>";
    
    foreach ($event as $event) {
        $size =  $event['commentcount'] + 1;
        echo "<li><a href='CommentView.php?id=".$event['activityid']."&title=".$event['activitytitle']."&des= ".$event['activitydescription']."'><div> Fecha de creacion: ".$event['createddate'].", Fecha de actualizacion: ".$event['updatedate'].", Numero de seguidores: ".$event['likecount'].", Cantidad de comentarios: ".$event['commentcount'].", Titulo: ".$event['activitytitle'].", Descripcion: ".$event['activitydescription'].", Lugar: ".$event['eventplace'].", Dia: ".$event['eventdate'].", Hora: ".$event['eventhour']."</div></a>";
        echo "</li>";
    }//End foreach ($events as $event) 
//    echo "</form>";
?>

<?php
    include_once '../public/footer.php';
?>   