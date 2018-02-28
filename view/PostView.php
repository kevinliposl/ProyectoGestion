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

echo "<h3>Publicaciones</h3>";
?>

<table>
    <tr>
        <th>Busqueda General</th>
        <th>Fecha</th>
    </tr>
    <tr>
        <td>
            <input type ='text' id="searchGeneral" placeholder="Busqueda General"/>
        </td>
        <td>
            <input type ='date' id="searchDate" placeholder="Fecha"/>
        </td>
        <td>
            <input type="button" id="search" value="Buscar"/> 
        </td>
    </tr>
</table>
<script>
    $("#search").click(function () {
        var args = {
            'searchGeneral': $('#searchGeneral').val().trim(),
            'searchDate': $('#searchDate').val(),
            'selectPost': 'selectPost'
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

<?php
echo '<br>';
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