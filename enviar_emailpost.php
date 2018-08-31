<?php

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
if (isset($_POST['EMAIL'])  && isset($_POST['MENSAJE']) && isset($_POST['REMITENTE']) ) {
  
    
           $email="From: noreply@yfys.eu";
    
    
            $sendemail  = $_POST['EMAIL'];
            $contenido=$_POST['MENSAJE'];
            $emailpersonal=$_POST['REMITENTE'];
           // $lang=$_POST['LANG'];
 
            require_once('databasename.php');

           $mysqli = new mysqli(SERVERMYSQL, USER, PASS, DATABASE);



          /* check connection */
          if (mysqli_connect_errno()) {
              printf("%s: %s\n", $menerror1,  mysqli_connect_error());
              exit();
          }
           
          
          $idper =mysqli_real_escape_string($mysqli,$sendemail);

          $query = "SELECT ID, EMAIL , NAME  FROM ".  TABLE_CONTACTPERSON ." WHERE ID  =" . $idper;
    
 
              
          $resultado= mysqli_query($mysqli,$query);
       
             while ($row = mysqli_fetch_row($resultado)) {
                     
                  $from  = $row[1];
                 $name = $row[2];
   
                }
 
     
    
 
            $url= $contenido ."  ".$emailpersonal;
              
             
            require_once('emailenvio.php');
              
           $mensajepart=$variablecabeza1 .$l_saludo .$name.$variablecabeza2. $l_mensaemailsend1.$variablecuerpo1.$l_mensaemailsend2. $variablecuerpo2. $l_mensaemailsend3.$variablecuerpo3.$url.$variablecuerpo6.$l_mensaemail5.$variablecuerpo7.$l_mensaemail6.$variablecuerpo8.$variablepie1.$variablepie2;
              

          

     
              $from      = $from;
              $titulo    = $l_mensaemailsend1;
              $mensaje   = $mensajepart;
              $cabeceras = 'From: noreply@yfys.eu' . "\r\n" ;
              $cabeceras .= "MIME-Version: 1.0" . "\r\n";
              $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              mail($from, $titulo, $mensaje, $cabeceras);
    
    

     		 mysqli_close($mysqli);
    
                 $response["success"] = 1;
    
        $response["message"] = "EMAIL OK.";

        // echoing JSON response
        echo json_encode($response);

        


 
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "EMAIL FAIL.";
        
        // echoing JSON response
        echo json_encode($response);
    }
 
?>