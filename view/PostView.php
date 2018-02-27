<?php

include_once '../public/header.php';
include_once '../business/PostBusiness.php';

require_once '../util/SSession.php';

if (!isset(SSession::getInstance()->user)) {
    header('location: ../index.php');
}
?>

<?php

$postBusiness = new PostBusiness();
$posts = $postBusiness->selectAllTotal();

//    echo "<form enctype='multipart/form-data' method='POST' action='../business/EventBusiness.php'>";
echo "<h3>Lista de Publicaciones</h3>";

foreach ($posts as $post) {
    $size = $post['activitycommentcount'] + 1;
    echo "<li><a href='CommentView.php?id=" . $post['activityid'] . "&title=" . $post['activitytitle'] . "&des= " . $post['activitydescription'] . "'><div> Fecha de creacion: " . $post['activitycreateddate'] . ", Fecha de actualizacion: " . $post['activityupdatedate'] . ", Numero de seguidores: " . $post['activitylikecount'] . ", Cantidad de comentarios: " . $post['activitycommentcount'] . ", Titulo: " . $post['activitytitle'] . ", Descripcion: " . $post['activitydescription'] . "</div></a>";
    echo "</li>";
}//End foreach ($events as $event) 
//    echo "</form>";
?>

<?php

include_once '../public/footer.php';
?>   