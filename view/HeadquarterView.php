<?php
include_once '../public/header.php';
?>

<table>
    <thead>
    <tr>
        <th>Nombre de Universidad</th>
        <th>Sede?</th>
    </tr>
    </thead>
    <tbody>
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

    </tr>
    </tbody>

</table>

<table name="tabeE" id="tableE" style="display: none;">
    <thead>
        <tr>
        <th>Codigo del Recinto</th>
        <th>Nombre del Recinto</th>  
   
    </tr>
     </thead>
        <tbody>
    <tr>
           <td>
            <input type="text" name="codeE" id="codeE"/>

        </td>
        <td>
            <input type="text" name="nameE" id="nameE" pattern="[a-zA-Z\s]+$"/>
        </td>            

    </tr> 
        </tbody>
</table>
<br>
<table name="tableH" id="tableH" style="display: none;">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th>Codigo del Recinto</th>
            <th>Nombre del Recinto</th>        
            <th>Ubicacion del Recinto</th>
            <th>Id de la Universidad del Recinto</th>
        </tr>
    </thead>

    
    <form enctype="multipart/form-data" method='POST' action='../business/HeadquarterBusiness.php'>
        <tbody>
            <tr>
            <td></td>
            <td></td>
            <td>
                <input type="text" name="codeH" id="codeH"/>
            </td>

            <td>
                <input type="text" name="nameH" id="nameH" pattern="[a-zA-Z\s]+$"/>
            </td>            
            <td>
                <input type="text" name="locationH" id="locationH" pattern="[a-zA-Z\s]+$"/>
            </td>
            <td>
                <input type="text" name="universityidH" id="universityidH"/>
            </td>            
            <td>
                <input type="submit" name="create" value="Crear"/> 
            </td>
        </tr>
        </tbody>
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
  } */
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

            var tableE = document.getElementById("tableE");
            tableE.style.display = "inline";
          
           var tableH = document.getElementById("tableH");
            tableH.style.display = "none";
          
            return false;
        }
        
        if ($("#enclosure").val() === '0') {
            
            var tableH = document.getElementById("tableH");
            tableH.style.display = "inline";
            
            var tableE = document.getElementById("tableE");
            tableE.style.display = "none";
            
            return false;
        }

    });

    $('#codeE').on('keyup', function () {
        
            var tableH = document.getElementById("tableH");
            tableH.style.display = "inline";
            
            return false;
    });

</script>


<?php
include_once '../public/footer.php';
