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
        $patient_id = $_POST['patient_id'];
        //echo $patient_id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://localhost:8280/cs173/querypatient/'.$patient_id
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
