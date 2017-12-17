<?php
//error_reporting( E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING );
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Update Patient</title>
  </head>
  <body>
<?php
    include("update2.php");
    if (isset($_POST['update'])){

      //echo 'hello';
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
      //echo $xml;
      echo $xml->person->givenName;
      $time = str_replace(' ', 'T',date("Y-m-d H:i:s"));
      $time .= ".000-00:00";
      $xml->familyName = $_POST['family_name'];
      $xml->givenName = $_POST['given_name'];
      $xml->middleName = $_POST['middle_name'];
      $xml->gender = $_POST['sex'];
      $xml->dateOfBirth = $_POST['birthdate'];
      $xml->city =  $_POST['city'];
      $xml->state = $_POST['state'];
      $xml->postal = $_POST['postal'];
      $xml->country = $_POST['state'];
      $xml->dateChanged = $time;

      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, 'http://localhost:8280/cs173/updatepatient/');
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml','OPENEMPI_SESSION_KEY:'.$key));
      curl_setopt($curl, CURLOPT_POST, 1);
    // Following line is compulsary to add as it is:
      curl_setopt($curl, CURLOPT_POSTFIELDS,$xml);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
      $result = curl_exec($curl);
      $xml = simplexml_load_string($result);
      //echo $result;
      $json = json_encode($xml);
      echo $json;
}

?>
<a class='btn' href='/cs173/index.php'>Back</a></center>

</body>
</html>
