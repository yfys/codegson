<?php

 

// array for JSON response
$response = array();
 


if (!isset($_GET['LANG'])) { $_GET['LANG'] = 'en'; }

if     ($_GET['LANG'] == 'en') { include_once("lang_en.php"); }
elseif ($_GET['LANG'] == 'es') { include_once("lang_es.php"); }
elseif ($_GET['LANG'] == 'pt') { include_once("lang_pt.php"); }
elseif ($_GET['LANG'] == 'it') { include_once("lang_it.php"); }
 
$response = array();



if (isset($_GET["email"])) {
    $email = $_GET['email'];
    $lang =  $_GET['LANG'];
  include('databasename.php');
  $link = mysqli_connect(SERVERMYSQL, USER, PASS, DATABASE);
    
    if (mysqli_connect_errno()) {
        printf("%s: %s\n", $menerror1, $mysqli->connect_error);
        exit();
    }
  
    $email = mysqli_real_escape_string($link,$email);
     
$query = "SELECT NAME, EMAIL FROM " . TABLE_CONTACTPERSON.  "  WHERE EMAIL = '" .$email . "' and CONFIRMEMAIL ='1' and CONFIRMEMAILINST ='1' ";
    
	
if ($result = mysqli_query($link, $query) or die(mysql_error()) ) {

      if (mysqli_num_rows($result) == 1) {
      	//Enviar email
        while ($row = mysqli_fetch_array($result)) {
         
         $name = $row['NAME'];
         
         
      
	   }
          
          /// ENVIO  DE EMAIL

           $url1= ADDRES_SERVER."/".$lang."/resetpassword".$lang."/"."?email=".  $email;

          
       
             
              require_once('emailregistro.php');
              
        
              
          $texto=$variablecabeza1 .$l_saludo .$name.$variablecabeza2. $l_mensaemailrestablece.$variablecuerpo1.$l_mensaemailrestablece2. $variablecuerpo2. $l_mensaemailrestablece3.$variablecuerpo3.$variablecuerpo4.$url1.$variablecuerpo5.$l_mensaemail4.$variablecuerpo6.$l_mensaemail5.$variablecuerpo7.$l_mensaemail6.$variablecuerpo8.$variablepie1.$variablepie2;
        
            $from      = $email;
			$titulo    = $l_titulo;
			$mensaje   = $texto;
          
              $cabeceras = 'From: noreply@yfys.eu' . "\r\n" ;
              $cabeceras .= "MIME-Version: 1.0" . "\r\n";
              $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
          
			$enviado=mail($from, $titulo, $mensaje,$cabeceras);

			if($enviado){
				    $response["success"] = 1;
        $response["message"] = "EMAIL";
                echo json_encode($response);
			}
			else{
				  $response["success"] = 0;
        $response["message"] = "No EMAIL found";

        // echo no users JSON
        echo json_encode($response);
			}
   }
   else {
     $response["success"] = 0;
        $response["message"] = "No EMAIL found";

        // echo no users JSON
        echo json_encode($response);

   }
 
   /* free result set */
    mysqli_free_result($result);
} else {
        // no yf_CONTACTPERSON found
        $response["success"] = 0;
        $response["message"] = "No EMAIL found";

        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>