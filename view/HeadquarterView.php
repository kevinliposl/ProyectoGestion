<?php
include_once '../public/header.php';
?>

<table>
    <tr>
        <th>Nombre de Universidad</th>
        <th>Sede?</th>
        <th id="thE1" name="thE1" style="visibility: hidden">Codigo del Recinto</th>
        <th id="thE2" name="thE2" style="visibility: hidden">Nombre del Recinto</th>        
    </tr>
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
                <input type="text" name="codeE" id="codeE" style="visibility: hidden"/>
                
            </td>
            <td>
                <input type="text" name="nameE" id="nameE" pattern="[a-zA-Z\s]+$" style="visibility: hidden"/>
            </td>            
           
            <td>
            </td>
        </tr>
</table>

<table>
      <tr>
        <th id="thH" style="visibility: hidden">Codigo del Recinto</th>
        <th id="thH" style="visibility: hidden">Nombre del Recinto</th>        
        <th id="thH" style="visibility: hidden">Ubicacion del Recinto</th>
        <th id="thH" style="visibility: hidden">Id de la Universidad del Recinto</th>
    </tr>
    
    <form enctype="multipart/form-data" method='POST' action='../business/HeadquarterBusiness.php'>
        <tr>
            <td></td>
            <td></td>
            <td>
                <input type="text" name="codeH" id="codeH" style="visibility: hidden"/>
            </td>
         
            <td>
                <input type="text" name="nameH" id="nameH" pattern="[a-zA-Z\s]+$" style="visibility: hidden"/>
            </td>            
            <td>
                <input type="text" name="locationH" id="locationH" pattern="[a-zA-Z\s]+$" style="visibility: hidden"/>
            </td>
            <td>
                <input type="text" name="universityidH" id="universityidH" style="visibility: hidden"/>
            </td>            
            <td>
                <input type="submit" name="create" value="Crear"/> 
            </td>
        </tr>
    </form>
</table>
    
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
            
            var thE1 = document.getElementById("thE1");
            thE1.style.visility = "visible";
            var thE2 = document.getElementById("thE2");
            thE2.style.visility = "visible";
            var codeE = document.getElementById("codeE");
            codeE.style.visibility = "visible";
            var nameE = document.getElementById("nameE");
            nameE.style.visibility= "visible";
       
            
            return false;
        }
        
    });
    
    $('#codeE').on('keyup', function() {
       var codeH = document.getElementById("codeH");
            codeH.style.visibility = "visible";
            var nameH = document.getElementById("nameH");
            nameH.style.visibility= "visible";
            var locationH = document.getElementById("locationH");
            locationH.style.visibility = "visible";
            var universityidH = document.getElementById("universityidH");
            universityidH.style.visibility = "visible";
            
        return false;
});
    
</script>


<?php

    include_once '../public/footer.php';