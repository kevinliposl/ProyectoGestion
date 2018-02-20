<?php
include_once '../public/header.php';

include_once '../business/PostBusiness.php';
?>

<?php
    $postBusiness = new PostBusiness();
    $posts = $postBusiness->selectAllTotal();

//    echo "<form enctype='multipart/form-data' method='POST' action='../business/EventBusiness.php'>";
    echo "<h3>Lista de Publicaciones</h3>";
    
    foreach ($posts as $post) {
        $size =  $post['commentcount'] + 1;
        echo "<li><a href='CommentView.php?id=".$post['activityid']."&title=".$post['activitytitle']."&des= ".$post['activitydescription']."'><div> Fecha de creacion: ".$post['createddate'].", Fecha de actualizacion: ".$post['updatedate'].", Numero de seguidores: ".$post['likecount'].", Cantidad de comentarios: ".$post['commentcount'].", Titulo: ".$post['activitytitle'].", Descripcion: ".$post['activitydescription']."</div></a>";
        echo "</li>";
    }//End foreach ($events as $event) 
//    echo "</form>";
?>

<?php
    include_once '../public/footer.php';
?>   