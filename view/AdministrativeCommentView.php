<?php
include_once '../public/header.php';

include_once '../business/CommentBusiness.php';
$commentBusiness = new CommentBusiness();

include_once '../business/ActivityBusiness.php';
$activityBusiness = new ActivityBusiness();
?>
<table>
    <tr>
        <th>Actividad</th>
        <th>Comentario</th>
        <th>Usuario</th>
    </tr>
    <form enctype="multipart/form-data" method='POST' action='../business/CommentBusiness.php'>
        <tr>
          
            <td>

                <select name="activity" style="width: 100%">
                    <option value="0">Ninguna</option>

                    <?php
                    $activities = $activityBusiness->selectAll();

                    foreach ($activities as $activity) {
                        ?>
                        <option value=" <?= $activity->getActivityId(); ?> "> <?= $activity->getActivityDescription(); ?> </option>

                        <?php
                    }
                    ?>

                </select>
            </td>
            </td>
            <td>
                <input type ='text' name="comment"/>
            </td>
            <td>
                <input type="text" name="actor"/>
            </td>

            <td>
                <input type="submit" name="create" value="Crear"/> 
            </td>
            <td>
            </td>
        </tr>
    </form>

<?php
 $comments = $commentBusiness->selectAll();

  foreach ($comments as $comment) {

  echo "<form enctype='multipart/form-data' method='POST' action='../business/CommentBusiness.php'>";
  echo "<tr>";
  echo "<td>";
  echo "<input type ='text' name='activityid' value='" . $comment->getActivityId() . "'/>";
  echo "</td>";
  echo "<td>";
  echo "<input type ='text' name='commentid' value='" . $comment->getCommentId() . "'/>";
  echo "</td>";
  echo "<td>";
  echo "<input type = 'text' name='commentdescription' value='" . $comment->getCommentDescription() . "'/>";
  echo "</td>";
  
  echo "<td>";
  echo "<input type ='submit' name='delete' value ='Eliminar'/>";
  echo "</td>";
 
  echo "</tr>";
  echo "</form>";
  } 
?>

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