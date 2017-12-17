<!DOCTYPE html>
<html>
  <head>
    <title>Get Patient</title>
  </head>
  <body>
    <?php
    $form = "<form action='readhwr.php' method='post'>
      <table>
        <tr>
    			<td>Forename</td>
            <td><input name='fname' type='text'  required></td>
        </tr>
        <tr>
    			<td>Surname</td>
            <td><input name='sname' type='text'  required></td>
        </tr>
        <tr>
          <td><input type='submit' name = 'read_provider'/></td>
        </tr>
      </table>
    </form>";
      if (isset($_POST['read_provider']))
      {

        $fname = $_POST['fname'];
        $sname = $_POST['sname'];
        //echo $patient_id;
        $XML = "<csd:requestParams xmlns:csd=\"urn:ihe:iti:csd:2013\">
		<csd:commonName>".$sname.", ".$fname."</csd:commonName> </csd:requestParams>";
        echo $XML;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://localhost:8280/cs173/queryhwr/');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        curl_setopt($curl, CURLOPT_POST, 1);
  // Following line is compulsary to add as it is:
        curl_setopt($curl, CURLOPT_POSTFIELDS,
                    $XML);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $xml = simplexml_load_string($result);
        $json = json_encode($xml);

        if($result){
          echo '<h2> HWR Results:</h2><br>';
          echo $json;
        }
        else {
          echo 'No patient found';
        }

        //echo prettyPrint($json);

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
