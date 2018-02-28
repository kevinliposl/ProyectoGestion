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

echo "<h3>Lista de Publicaciones</h3>";
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
            $('#message').html(JSON.stringify(data.result));
            //for (var dat in data.result) {
//                $('#message').html("<li><a href='CommentView.php?id=" + dat.activityid + "&title="+ dat.activitytitle+ "&des= " + dat.activitydescription+ "'><div> Fecha de creacion: " + dat.activitycreateddate+ ", Fecha de actualizacion: " + dat.activityupdatedate+ ", Numero de seguidores: " + dat.activitylikecount+ ", Cantidad de comentarios: " + dat.activitycommentcount+", Titulo: " + dat.activitytitle+ ", Descripcion: " + dat.activitydescription+ ", Lugar: " + dat.eventplace+ ", Dia: " + dat.eventdate+ ", Hora: " + dat.eventhour+ "</div></a></li>");
            //$('#message').html("<li><a href='CommentView.php?id=" + dat.activityid+ "&title=" + dat.activitytitle + "&des= " + dat.activitydescription + "'><div> Fecha de creacion: " + dat.activitycreateddate+ ", Fecha de actualizacion: " + dat.activityupdatedate+", Numero de seguidores: " + dat.activitylikecount+ ", Cantidad de comentarios: " + dat.activitycommentcount+ ", Titulo: " + dat.activitytitle+ ", Descripcion: " + dat.activitydescription+ "</div></a></li>");
            //}
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