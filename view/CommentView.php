<?php
include_once '../public/header.php';

include_once '../business/CommentBusiness.php';
$commentBusinessF = new CommentBusiness();

include_once '../business/ActivityBusiness.php';
$activityBusiness = new ActivityBusiness();
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
<table>
    <tr>
        <th>Comentario</th>
    </tr>
    <form enctype="multipart/form-data" method='POST' action='../business/CommentBusiness.php'>
        <tr>
            <td>
                <input type ='text' name="commentdescription"/>
            </td>
            <td>
                <input type="submit" name="create" value="Crear"/> 
            </td>
            <td>
            </td>
        </tr>
    </form>
    </table>

<?php
    include_once '../public/footer.php';
?>  