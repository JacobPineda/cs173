<!DOCTYPE html>
<html>
  <head>
    <title>Get Patient</title>
  </head>
  <body>
    <?php
    $form = "<form action='read.php' method='post'>
      <table>
        <tr> 
    			<td>Patient ID</td>
            <td><input name='patient_id' type='text'  required></td>
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

        $patient_id = $_POST['patient_id'];
        //echo $patient_id;
        $XML = "<person><givenName>".$patient_id;
        $XML .= "</givenName></person>";
        //echo $XML;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://localhost:8280/cs173/querypatient/');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml','OPENEMPI_SESSION_KEY:'.$result));
        curl_setopt($curl, CURLOPT_POST, 1);
  // Following line is compulsary to add as it is:
        curl_setopt($curl, CURLOPT_POSTFIELDS,
                    $XML);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $xml = simplexml_load_string($result);
        $json = json_encode($xml);
        echo $json;
        curl_close($curl);

      }
      else {
        echo "$form";
      }

    ?>
    <br>
    <a class='btn' href='/cs173/index.php'>Back</a></center>
  </body>
</html>
