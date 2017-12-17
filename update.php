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
    $form = "<form action='update.php' method='post'>


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
      //$test = simplexml_load_string($XML);
      //echo $test->person->familyName;
      //$a = json_encode($XML);
      //echo $a;
      //echo date("Y-m-d H:i:s");
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

      //echo $json;

      if($result){
        /*if(substr_count($json,"person")>1){
          //multiples
        }
        else {

        }*/
        echo "<h3>Search Results:</h3>".$json;
        $update_form = "<form action='update.php' method='post'>
          <h3>Person Identifiers</h3>
          <table>
              <!--<tr> 
          			<td>Person ID</td>
                  <td><input name='pid' type='number'  required></td>
            </tr>
            <tr> 
          			<td>Date created</td>
                  <td><input name='date' type='text'  required></td>
            </tr>-->
            <tr> 
          			<td>Identifier</td>
                  <td><input name='id' type='text'  required></td>
            </tr>
          <!--<tr> 
          			<td>Identifier Domain ID</td>
                  <td><input name='id_domain_id' type='text'  required></td>
            </tr>
            <tr> 
          			<td>Identifier Domain Name</td>
                  <td><input name='id_domain_name' type='text'  required></td>
            </tr>
            <tr> 
          			<td>Namespace Identifier</td>
                  <td><input name='name_id' type='text'  required></td>
            </tr>
            <tr> 
          			<td>Universal Identifier</td>
                  <td><input name='uni_id' type='text'  required></td>
            </tr>
            <tr> 
          			<td>Universal Identifier Type Code</td>
                  <td><input name='type_code' type='text'  required></td> -->
            </tr>
          </table>
          <h3>Person Attributes</h3>
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
            <br>
            <tr>
              <td><input type='submit' name = 'update_patient'/></td>
            </tr>
          </table>
        </form>";
        $time = str_replace(' ', 'T',date("Y-m-d H:i:s"));
        $time .= ".000-00:00";
        //echo $time;
        if (isset($_POST['update_patient'])){


              $XML = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?><authenticationRequest><password>admin</password><username>admin</username></authenticationRequest>";
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

              $XML = "<?xml version='1.0' encoding='UTF-8' standalone='yes'?>
                  <person>
                    <dateChanged>".$time."</dateChanged>
                    <familyName>".$_POST['family_name']."</familyName>
                    <givenName>".$_POST['given_name']."</givenName>
                    <middleName>".$_POST['middle_name']."</middleName>
                    <gender>".$_POST['sex']."</gender>
                    <dateOfBirth>".$_POST['birthdate']."</dateOfBirth>
                    <city>".$_POST['city']."</city>
                    <state>".$_POST['state']."</state>
                    <postal>".$_POST['postal']."</postal>
                    <country>".$_POST['country']."</country></person>
                    <personIdentifiers>
                      <identifier>".$_POST['id']."</identifier>
                    </personIdentifiers>
                  </person>";

              $curl = curl_init();
              curl_setopt($curl, CURLOPT_URL, 'http://localhost:8280/cs173/updatepatient/');
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
              echo $json;
        }
        else {
          echo $update_form;
        }
      }
      else {
        echo 'No patient found';
        //echo $XML;
      }

    }
    else {
      echo "$form";
    }

  ?>
    <br>
    <a class='btn' href='/cs173/index.php'>Back</a></center>
  </body>
</html>
