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
          <td><input type='submit' name = create_patient/></td>
        </tr>
      </table>
    </form>";
    if (isset($_POST['create_patient']))
    {
      $object->name->gname = $_POST['given_name'];
      $object->name->fname = $_POST['family_name'];
      $object->name->initial = $_POST['initial'];
      $object->sex = $_POST['sex'];
      $object->bdate = $_POST['birthdate'];
      $object->city = $_POST['city'];
      $object->state = $_POST['state'];
      $object->postal = $_POST['postal'];
      $object->country = $_POST['country'];

      $JSON = json_encode($object);
      echo $JSON;
      //echo $patient_id;
      curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => 'http://localhost:8280/cs173/createpatient/',
      CURLOPT_POST => 1,
      CURLOPT_POSTFIELDS => array(
        given_name => $patient_gname,
        first_name => $patient_fname,
        intial => $intiial,
        sex => $sex,
        bdate => $bdate,
        city => $city,
        state => $state,
        postal => $postal,
        country => $country
      )
      ));
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
