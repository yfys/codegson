<?php
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response

 


if (!isset($_POST['LANG'])) { $_POST['LANG'] = 'en'; }

if     ($_POST['LANG'] == 'en') { include_once("lang_en.php"); }
elseif ($_POST['LANG'] == 'es') { include_once("lang_es.php"); }
elseif ($_POST['LANG'] == 'pt') { include_once("lang_pt.php"); }
elseif ($_POST['LANG'] == 'it') { include_once("lang_it.php"); }
 

$response = array();




// check for required fields
if (isset($_POST['EMAIL']) && isset($_POST['NAME']) && isset($_POST['LASTNAME']) && isset($_POST['AREA']) && isset($_POST['PASSWORD']) &&  isset($_POST['EMAILINST']) && isset($_POST['NAMEINST']) && isset($_POST['STREET']) && isset($_POST['CITY']) && isset($_POST['COUNTRY']) && isset($_POST['TYPE'])  && isset($_POST['KTYPE'])   && isset($_POST['LANG'])  ) {
  
    $email = $_POST["EMAIL"];
	$area = $_POST["AREA"];
    $name = $_POST["NAME"];
	$lastname = $_POST["LASTNAME"];
	$password = $_POST["PASSWORD"];
  
    $emailcenter = $_POST["EMAILINST"];
    $namecenter = $_POST["NAMEINST"];
	$street = $_POST["STREET"];
	$city = $_POST["CITY"];
	$country = $_POST["COUNTRY"];
	$type = $_POST["TYPE"];

    
    $nameproject = $_POST["NAMEPROJECT"];
	$ktype = $_POST["KTYPE"];
   
    $lang=$_POST['LANG'];
    
 
    
     require_once('databasename.php');

          $mysqli = new mysqli(SERVERMYSQL, USER, PASS, DATABASE);
 


 
          if (mysqli_connect_errno()) {
              printf("%s: %s\n", $menerror1,  mysqli_connect_error());
              exit();
          }
          //check if institution exists
    
          //check if persons exists
          $email=mysqli_real_escape_string($mysqli,$email);

          $query = "SELECT ID  FROM ". TABLE_CONTACTPERSON ." WHERE EMAIL  = '" . $email. "'";
           
    
          $resultado= mysqli_query($mysqli,$query);

          $row_cnt = mysqli_num_rows($resultado);
          
          $row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

          if ( $row_cnt >=1 ){
            // 
           
            $result=0;  
            $idperson = $row["ID"];
            $confirmemailpeople=1;
          }
          else {
            //Guardamos los datos de la persona
            $emailcenter=mysqli_real_escape_string($mysqli,$emailcenter);
      
            $namecenter=mysqli_real_escape_string($mysqli,$namecenter);
     
            $street = mysqli_real_escape_string($mysqli,$street);

            $city =mysqli_real_escape_string($mysqli,$city);

            $country =mysqli_real_escape_string($mysqli,$country);

            $emailcenter=mysqli_real_escape_string($mysqli,$emailcenter);

            $type=mysqli_real_escape_string($mysqli,$type);
              
              //Personas

              $name=mysqli_real_escape_string($mysqli,$name);
       
              $lastname = mysqli_real_escape_string($mysqli,$lastname);

              $email =mysqli_real_escape_string($mysqli,$email);

              $password =mysqli_real_escape_string($mysqli,$password);

              $password = password_hash($password, PASSWORD_DEFAULT);

              $emailcenter=mysqli_real_escape_string($mysqli,$emailcenter);

              $area=mysqli_real_escape_string($mysqli,$area);

             // inseramos institucion  
            $insertinsti= "INSERT " . TABLE_INSTITUTION.  " (EMAIL, NAME, STREET, CITY, COUNTRY, TYPE)  VALUES ('$emailcenter', '$namecenter','$street', '$city','$country',$type)";

             

            mysqli_query($mysqli, $insertinsti);

            $idinst = mysqli_insert_id($mysqli);
              
              // insertamos la persona

              $insert= "INSERT " . TABLE_CONTACTPERSON.  " (EMAIL, NAME, LASTNAME, CONFIRMEMAIL, CONFIRMEMAILINST, AREA, PASSWORD, IDINST)  VALUES ('$email','$name', '$lastname',0, 0,$area,'$password',$idinst)";

              


               mysqli_query($mysqli, $insert);

              $idperson = mysqli_insert_id($mysqli);
              
              

            $nameproject=mysqli_real_escape_string($mysqli,$nameproject);
     
            $ktype = mysqli_real_escape_string($mysqli,$ktype);

            

            $insert= "INSERT " . TABLE_PROJECT .  " ( NAME, IDCONTACT, KTYPE)  VALUES ('$nameproject',$idperson,$ktype)";

            mysqli_query($mysqli, $insert);

            $idproyect = mysqli_insert_id($mysqli);

             mysqli_free_result($resultado);


            mysqli_close($mysqli);
          
            $result=1;
    
    // AQUI HAY QUE ENVIAR LOS EMAILS
    
    

          $url1= ADDRES_SERVER."/" .$lang."/endregister".$lang."?idinst=".   urlencode( $idinst."#".md5($idinst));
              $persona=urlencode($idperson."#".md5($idperson));
            $url1=$url1."&idper=".$persona;
              
         
            
            
            $url2= ADDRES_SERVER."/" .$lang."/endregister".$lang."?idper=". urlencode($idperson."#".md5($idperson));  
 
                         
              
             
              require_once('emailregistro.php');
              
           
   
              
          $mensaje2=$variablecabeza1 .$l_saludo .$name.$variablecabeza2. $l_mensaemail1.$variablecuerpo1.$l_mensaemail2. $variablecuerpo2. $l_mensaemail3.$variablecuerpo3.$variablecuerpo4.$url2.$variablecuerpo5.$l_mensaemail4.$variablecuerpo6.$l_mensaemail5.$variablecuerpo7.$l_mensaemail6.$variablecuerpo8.$variablepie1.$variablepie2;
         
              
              $from      = $email;
              $titulo    = $l_mensaemail1;
              $mensaje   = $mensaje2;
              $cabeceras = 'From: noreply@yfys.eu' . "\r\n" ;
              $cabeceras .= "MIME-Version: 1.0" . "\r\n";
              $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              mail($from, $titulo, $mensaje, $cabeceras);

    
          }

    
    // HASTA AQUI SE ENVIA EL EMAIL

    // check if row inserted or not
    if ($result ) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Registro OK.";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! Ha ocurido un error inesperado.";
        
        // echoing JSON response
        echo json_encode($response);
    }

} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Se requieren campos que están vacíos";

    // echoing JSON response
    echo json_encode($response);
}

?>