<?php
include_once '../public/header.php';
?>

<table>
    <tr>
        <th>Nombre de Universidad</th>
        <th>Sede?</th>
        <th>Codigo del Recinto</th>
        <th>Nombre del Recinto</th>        
        <th>Ubicacion del Recinto</th>
        <th>Id de la Universidad del Recinto</th>
    </tr>
    <form enctype="multipart/form-data" method='POST' action='../business/HeadquarterBusiness.php'>
        <tr>
            <td>
                <?php
    
                include '../business/UniversityBusiness.php';
                
                $universityBusiness = new UniversityBusiness();
                $currentUniversity = new University();
                $universities = $universityBusiness->selectAll();
                ?>
                
                <select>
                    <?php
                    foreach ($universities as $currentUniversity) {
                    ?>
                    <option value="<?php print_r($currentUniversity->getUniversityid()) ?>"><?php print_r($currentUniversity->getUniversityName()) ?></option>
                        
                        <?php 
                        }
                        ?> 
                </select> 
  
            </td>
            <td>
                <select name="enclosure" id="enclosure">
                    <option value="2">Ninguna</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
            </td>
            <td>
                <input type="text" name="code" id="code" hidden="true"/>
            </td>
            <td>
                <input type="text" name="name" pattern="[a-zA-Z\s]+$" hidden="true"/>
            </td>            
            <td>
                <input type="text" name="location" pattern="[a-zA-Z\s]+$" hidden="true"/>
            </td>
            <td>
                <input type="text" name="universityid" hidden="true"/>
            </td>            
            <td>
                <input type="submit" name="create" value="Crear"/> 
            </td>
            <td>
            </td>
        </tr>
    </form>
    
    <?php
    include '../business/HeadquarterBusiness.php';

    $headquarterBusiness = new HeadquarterBusiness();
    $headquarters = $headquarterBusiness->selectAll();

   /** foreach ($headquarters as $headquarter){

        echo "<form enctype='multipart/form-data' method='POST' action='../business/HeadquarterBusiness.php'>";
        echo "<tr>";
        echo "<td>";
        echo "<input type ='text' name='code' value='" . $headquarter['headquartercode'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type = 'text' name='name' value='" . $headquarter['headquartername'] . "' pattern ='[a-zA-Z\s]+$'/>";
        echo "</td>";        
        echo "<td>";
        echo "<input type ='text' name='location' value='" . $headquarter['headquarterlocation'] ."' pattern ='[a-zA-Z\s]+$'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type = 'text' name='universityid' value='" . $headquarter['headquarteruniversityid'] . "'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='submit' name='delete' value ='Eliminar'/>";
        echo "</td>";
        echo "<td>";
        echo "<input type ='submit' name='update' value ='Actualizar'/>";
        echo "</td>";
        echo "</tr>";
        echo "</form>";
    }*/
    ?>
    
    <tr>
        <td></td>
        <td>
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "empty") {
                    echo '<p style="color: red">Campo(s) vacio(s)</p>';
                } else if ($_GET['error'] == "format") {
                    echo '<p style="color: red">Error, formato de numero</p>';
                } else if ($_GET['error'] == "dbError") {
                    echo '<center><p style="color: red">Error al procesar la transacción</p></center>';
                }
            } else if (isset($_GET['success'])) {
                echo '<p style="color: green">Transacción realizada</p>';
            }
            ?>
        </td>
    </tr>
    
    <script type="text/javascript" async>
    
    $("#enclosure").change(function () {

        if ($("#enclosure").val() === '1') {
            
            var code= document.getElementById("code");
            code.style.visibility = "visible";
            
            return false;
        }
        
    });
    
</script>


<?php

    include_once '../public/footer.php';