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
    $form = "<form action='read.php' method='post'>
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
    if (isset($_POST['read_patient']))
    {


      $XML = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?><authenticationRequest><password>admin</password><username>admin</username></authenticationRequest>";
      //echo $XML;  
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, 'http://localhost:8280/cs173/authenticate/');
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
      curl_setopt($curl, CURLOPT_POST, 1);
// Following line is compulsary to add as it is:
      curl_setopt($curl, CURLOPT_POSTFIELDS,
                  $XML);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
      $result = curl_exec($curl);
      $key = $result;
      //echo $result;
      curl_close($curl);

      $gname = $_POST['given_name'];
      $fname = $_POST['family_name'];
      $mname = $_POST['middle_name'];
      //echo $patient_id;
      $XML = "<person><givenName>".$gname."</givenName>
              <familyName>".$fname."</familyName>
              <middleName>".$mname."</middleName></person>";
      //echo $XML;
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, 'http://localhost:8280/cs173/querypatient/');
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml','OPENEMPI_SESSION_KEY:'.$key));
      curl_setopt($curl, CURLOPT_POST, 1);
// Following line is compulsary to add as it is:
      curl_setopt($curl, CURLOPT_POSTFIELDS,
                  $XML);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      $result = curl_exec($curl);
      $xml = simplexml_load_string($result);
      $json = json_encode($xml);
      //echo prettyPrint($json);
      //curl_close($curl);
      echo $json;

    }
    else {
      echo "$form";
    }

  ?>
    <br>
    <a class='btn' href='/cs173/index.php'>Back</a></center>
  </body>
</html>
