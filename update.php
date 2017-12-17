<?php
error_reporting( E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING );
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Update Patient</title>
  </head>
  <body>
    <?php
    $form = "<form action='update2.php' method='post'>


      <table>
          <tr> 
      			<td>Given Name</td>
              <td><input name='given_name' type='text'  required></td>
        </tr>
        <tr> 
      			<td>Family Name</td>
              <td><input name='family_name' type='text'  required></td>
        </tr>
        <tr> 
      			<td>Middle Name</td>
              <td><input name='middle_name' type='text'  required></td>
        </tr>
        <tr>
          <td><input type='submit' name = 'read_patient'/></td>
        </tr>
      </table>
    </form>";
    echo $form;

  ?>
    <br>
    <a class='btn' href='/cs173/index.php'>Back</a></center>
  </body>
</html>
