<?php
error_reporting( E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING );
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Create Patient</title>
  </head>
  <body>
    <?php
    $form = "<form action='create.php' method='post'>
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
            <td>&emsp; Middle Name</td>
              <td><input name='middle_name' type='text'  required></td>
          </tr>
          <tr>
            <td>Sex</td>
            <td><select name='sex'><option value='M'>Male</option><option value='F'>Female</option></select><td>
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
          <td><input type='submit' name = 'create_patient'/></td>
        </tr>
      </table>
    </form>";
    if (isset($_POST['create_patient']))
    {
      /**$object = NULL;
      $object->name->gname = $_POST['given_name'];
      $object->name->fname = $_POST['family_name'];
      $object->name->middle_name = $_POST['middle_name'];
      $object->sex = $_POST['sex'];
      $object->bdate = $_POST['birthdate'];
      $object->address->city = $_POST['city'];
      $object->address->state = $_POST['state'];
      $object->address->postal = $_POST['postal'];
      $object->address->country = $_POST['country'];**/

      $XML = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?><authenticationRequest><password>admin</password><username>admin</username></authenticationRequest>";
      //echo $XML;
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, 'http://localhost:8280/cs173/authenticate/');
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
      curl_setopt($curl, CURLOPT_POST, 1);
    // Following line is compulsary to add as it is:
      curl_setopt($curl, CURLOPT_POSTFIELDS,$XML);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
      $result = curl_exec($curl);
      $key = $result;
      //echo $result;
      curl_close($curl);

      $gname = $_POST['given_name'];
      $fname = $_POST['family_name'];
      $mname = $_POST['middle_name'];
      $sex = $_POST['sex'];
      $bdate = $_POST['birthdate'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $postal = $_POST['postal'];
      $country = $_POST['country'];
      //echo $patient_id;
      $XML = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>
          <person>
            <familyName>".$fname."</familyName>
            <givenName>".$gname."</givenName>
            <middleName>".$mname."</middleName>
            <gender>".$sex."</gender>
            <dateOfBirth>".$bdate."</dateOfBirth>
            <city>".$city."</city>
            <state>".$state."</state>
            <postal>".$postal."</postal>
            <country>".$country."</country></person>";
      //echo $XML;
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, 'http://localhost:8280/cs173/createpatient/');
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml','OPENEMPI_SESSION_KEY:'.$key));
      curl_setopt($curl, CURLOPT_POST, 1);
    // Following line is compulsary to add as it is:
      curl_setopt($curl, CURLOPT_POSTFIELDS,
                  $XML);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
      $result = curl_exec($curl);
      $xml = simplexml_load_string($result);
      //echo $result;
      $json = json_encode($xml);
      echo '<h4> Patient created! </h4>'.$json;
      curl_close($curl);
    }
    else {
      echo "$form";
    }
    ?>
    <a class='btn' href='/cs173/index.php'>Back</a></center>
  </body>
</html>
