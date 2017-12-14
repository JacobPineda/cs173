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
    $form = "<form action='update.php' method='put'>
      <table>
          <tr>
            <td>Name</td>
          </tr>
          <tr> 
      			<td>&emsp; Family Name</td>
              <td><input name='family_name' type='text'  required></td>
          </tr>
          <tr>
            <td>&emsp; Given Name</td>
              <td><input name='given_name' type='text'  required></td>
          </tr>
          <tr>
            <td>&emsp; Initial</td>
              <td><input name='initial' type='text'  required></td>
          </tr>
          <tr>
            <td>Sex</td>
            <td><select name='sex'><option value='Male'>Male</option><option value='Female'>Female</option></select><td>
          </tr>
          <tr>
            <td>Birthdate</td>
              <td><input name='birthdate' type='date'  required></td>
          </tr>
          <tr>
            <tr>
              <td>Address</td>
            </tr>
            <tr>
              <td>&emsp; City</td>
              <td><input name='city' type='text'  required></td>
            </tr>
            <tr>
              <td>&emsp; State</td>
              <td><input name='state' type='text'  required></td>
            </tr>
            <tr>
              <td>&emsp; Postal Code</td>
              <td><input name='postal' type='number'  required></td>
            </tr>
            <tr>
              <td>&emsp; Country </td>
              <td><input name='country' type='text'  required></td>
            </tr>

          </tr>
        <tr>
          <td><input type='submit' name = 'update_patient'/></td>
        </tr>
      </table>
    </form>";
    if (isset($_POST['update_patient']))
    {
      $object = NULL;
      $object->name->gname = $_POST['given_name'];
      $object->name->fname = $_POST['family_name'];
      $object->name->initial = $_POST['initial'];
      $object->sex = $_POST['sex'];
      $object->bdate = $_POST['birthdate'];
      $object->address->city = $_POST['city'];
      $object->address->state = $_POST['state'];
      $object->address->postal = $_POST['postal'];
      $object->address->country = $_POST['country'];

      $JSON = json_encode($object);
      echo $JSON;
      //echo $patient_id;
      $curl = curl_init();
      curl_setopt( $curl, CURLOPT_POSTFIELDS, $JSON );
      curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
      # Return response instead of printing.
      curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
      curl_setopt( $curl, CURLOPT_URL, 'http://localhost:8280/cs173/createpatient/' );
      $result = curl_exec($curl);
      //echo $result;
      curl_close($curl);
    }
    else {
      echo "$form";
    }
    ?>
    <a class='btn' href='/cs173/index.php'>Back</a></center>
  </body>
</html>
