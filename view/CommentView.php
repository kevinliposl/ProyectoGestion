<?php
include_once '../public/header.php';

include_once '../business/CommentBusiness.php';
?>

<?php
    
    echo "<h3>Actividad</h3>";

    echo "<h4> ".$_GET['title'].", ".$_GET['des']."</h4>";    

    $commentBusiness = new CommentBusiness();
    $comments = $commentBusiness->selectidActivity($_GET['id']);
    
    echo "<h4>Comentarios</h4>";
    
    foreach ($comments as $comment) {
        echo "<li><a href='#'><div>".$comment['commentcreated'].",".$comment['commentactor'].",".$comment['commentdescription']."</div></a></li>";
    }//End foreach ($comments as $comment) 
    
?>

<?php
    include_once '../public/footer.php';
?>  