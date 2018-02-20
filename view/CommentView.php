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
    
    $des = $_GET['des'];
    $title = $_GET['title'];

    $commentBusiness = new CommentBusiness();
    $comments = $commentBusiness->selectidActivity($_GET['id']);
    
    echo "<h3>Comentarios</h3>";
    
    foreach ($comments as $comment) {
        echo "<div><h4>".$comment['actormail']."</h4>".$comment['commentdescription']." dia:".$comment['commentcreated']."</div>";
    }//End foreach ($comments as $comment) 

echo "<table>";
    echo "<tr>";
        echo "<th>Comentar</th>";
    echo "</tr>";
    echo "<form enctype='multipart/form-data' method='POST' action='../business/CommentBusiness.php'>";
        echo "<tr>";
            echo "<td>";
                echo "<input type ='text' name='commentdescription'/>";
            echo "</td>";
            echo "<td>";
                echo "<input type='submit' name='public' value='Publicar'/> ";
            echo "</td>";
            echo "<td>";
            echo "<input type='text' name='activityid' value='".$_GET['id']."' style='visibility:hidden'>";
            echo '</td>';
            echo '<td>';
            echo "<input type='text' name='activitytitle' value='".$des."' style='visibility:hidden'>";
            echo "</td>";
            echo "<td>";
            echo "<input type='text' name='activitydes' value='".$title."' style='visibility:hidden'>";
            echo "</td>";
            echo "<td>";
            echo "</td>";
        echo "</tr>";
    echo "</form>";
    echo "</table>";

    include_once '../public/footer.php';
?>  