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
    $form = "<form action='createenc.php' method='post' id ='encounter'>
      <table>
          <tr> 
      			<td>Patient Name</td>
              <td><input name='patient' type='text'  required></td>
          </tr>
          <tr>
            <td>Healthworker Name</td>
              <td><input name='hwr' type='text'  required></td>
          </tr>
          <tr>
            <td>Assessment</td>
              <td><input name='assessment' type='textarea' rows = '30' cols = '30' required></td>
          </tr>
        <tr>
          <td><input type='submit' name = 'create_enc'/></td>
        </tr>
      </table>
    </form>";


    if (isset($_POST['create_enc']))
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

      /**$XML = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?><authenticationRequest><password>admin</password><username>admin</username></authenticationRequest>";
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
      echo $result;
      curl_close($curl);**/

      /*$patient = $_POST['patient'];
      $hwr = $_POST['hwr'];
      $assessment = $_POST['assessment'];*/
      //echo $patient_id;
      $object = NULL;
      $object->patientname = $_POST['patient'];
      $object->workername = $_POST['hwr'];
      $object->assessment = $_POST['assessment'];
      $json = json_encode($object);
      echo $json;
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, 'http://localhost:8280/cs173/createencounter/');
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
      curl_setopt($curl, CURLOPT_POST, 1);
    // Following line is compulsary to add as it is:
      curl_setopt($curl, CURLOPT_POSTFIELDS,$json);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      //curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
      $result = curl_exec($curl);
      //$xml = simplexml_load_string($result);
      //echo $result;
      $json = json_encode($result);
      echo $json;
      curl_close($curl);
    }
    else {
      echo "$form";
    }
    ?>
    <a class='btn' href='/cs173/index.php'>Back</a></center>
  </body>
</html>
