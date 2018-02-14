<?php

include_once '../public/header.php';
?>
<table>
    <tr>
        <th>Busqueda General</th>
        <th>Fecha</th>
        <th>Tipo de Actividad</th>
        <th>Lugar</th>
        <th>Hora</th>
        <th>Actor</th>
    </tr>
    <tr>
        <td>
            <input type ='text' id="searchGeneral" placeholder="Busqueda General"/>
        </td>
        <td>
            <input type ='text' id="searchDate" placeholder="Fecha"/>
        </td>
        <td>
            <select id="typeActivity"style="width: 100%;">
                <option value="0">Evento</option>
                <option value="1">Actividad</option>
            </select>
        </td>
        <td>
            <input type="text" id="searchPlays" placeholder="Lugar">
        </td>
        <td>
            <input type="datetime" id="searchHour" placeholder="Hora">
        </td>
        <td>
            <input type="text" id="searchActor" placeholder="Actor">
        </td>
        <td>
            <input type="button" id="search" value="Buscar"/> 
        </td>
        <td>
        </td>
    </tr>
</table>
<script>
    $("#search").click(function () {
        var args = {
            'typeActivity': $('#typeActivity').val(),
            'searchGeneral': $('#searchGeneral').val(),
            'searchData': $('#searchDate').val(),
            'searchPlays': $('#searchPlays').val(),
            'searchActor': $('#searchActor').val()
        };

        $.post('../business/SearchBusiness.php', args, function () {
            
            
        }).fail(function () {
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

include_once '../public/footer.php';
