<!DOCTYPE html>
<html>
  <head>
    <title>Get Encouter</title>
  </head>
  <body>
    <?php
    function prettyPrint( $json )
    {
      $result = '';
      $level = 0;
      $in_quotes = false;
      $in_escape = false;
      $ends_line_level = NULL;
      $json_length = strlen( $json );

      for( $i = 0; $i < $json_length; $i++ ) {
          $char = $json[$i];
          $new_line_level = NULL;
          $post = "";
          if( $ends_line_level !== NULL ) {
              $new_line_level = $ends_line_level;
              $ends_line_level = NULL;
          }
          if ( $in_escape ) {
              $in_escape = false;
          } else if( $char === '"' ) {
              $in_quotes = !$in_quotes;
          } else if( ! $in_quotes ) {
              switch( $char ) {
                  case '}': case ']':
                      $level--;
                      $ends_line_level = NULL;
                      $new_line_level = $level;
                      break;

                  case '{': case '[':
                      $level++;
                  case ',':
                      $ends_line_level = $level;
                      break;

                  case ':':
                      $post = " ";
                      break;

                  case " ": case "\t": case "\n": case "\r":
                      $char = "";
                      $ends_line_level = $new_line_level;
                      $new_line_level = NULL;
                      break;
              }
          } else if ( $char === '\\' ) {
              $in_escape = true;
          }
          if( $new_line_level !== NULL ) {
              $result .= "\n".str_repeat( "\t", $new_line_level );
          }
          $result .= $char.$post;
      }

    return $result;
  }
    $form = "<form action='readenc.php' method='post'>
      <table>
        <tr> 
    			<td>Patient Name</td>
            <td><input name='patient' type='text'  required></td>
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

        $patient = $_POST['patient'];
        //$hwr = $_POST['healthworker'];

        //echo $patient_id;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://localhost:8280/cs173/queryencounter/'.$patient);
        echo $patient;
        //curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        //curl_setopt($curl, CURLOPT_POST, 1);
  // Following line is compulsary to add as it is:
        //curl_setopt($curl, CURLOPT_POSTFIELDS,$patient);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        //$xml = simplexml_load_string($result);
        //$json = json_encode($result);
        //echo prettyPrint($json);
        echo $result;
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
