<!DOCTYPE html>
<html>
  <head>
    <title>Get Encouter</title>
  </head>
  <body>
    <?php
    $form = "<form action='readenc.php' method='post'>
      <table>
        <tr> 
    			<td>Encounter ID</td>
            <td><input name='id' type='text'  required></td>
        </tr>
        <!--<tr> 
    			<td>Healthworker Name</td>
            <td><input name='healthworker' type='text'  required></td>
        </tr> -->
        <tr>
          <td><input type='submit' name = 'read_enc'/></td>
        </tr>
      </table>
    </form>";
      if (isset($_POST['read_enc']))
      {


        /**$XML = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?><authenticationRequest><password>admin</password><username>admin</username></authenticationRequest>";
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
        curl_close($curl);**/

        $id = $_POST['id'];
        //$hwr = $_POST['healthworker'];

        //echo $patient_id;
        $curl = curl_init();
        //$modified = str_replace(' ', '+',$id);
        curl_setopt($curl, CURLOPT_URL, 'http://localhost:8280/cs173/queryencounter/'.$id);
        //echo $modified;
        //curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        //curl_setopt($curl, CURLOPT_POST, 1);
  // Following line is compulsary to add as it is:
        //curl_setopt($curl, CURLOPT_POSTFIELDS,$patient);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        //$xml = simplexml_load_string($result);
        //$json = json_encode($result);
        //echo prettyPrint($json);

        if($result){
          echo '<h2>Encounter query result:</h2>';
          echo $result;
        }
        else {
          echo 'No encounter found';
        }

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
