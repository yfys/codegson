<?php
session_start();
extract($_POST);




$k = array_keys($_GET);
if (isset($_GET['lang'])) { $_SESSION['lang'] = $_GET['lang']; }
if (!isset($_SESSION['lang'])) { $_SESSION['lang'] = 'en'; }

if     ($_SESSION['lang'] == 'en') { include_once("lang_en.php"); }
elseif ($_SESSION['lang'] == 'es') { include_once("lang_es.php"); }
elseif ($_SESSION['lang'] == 'pt') { include_once("lang_pt.php"); }
elseif ($_SESSION['lang'] == 'it') { include_once("lang_it.php"); }


include('./databases/databasename.php');
$link = mysqli_connect(SERVERMYSQL, USER, PASS, DATABASE);

/* check connection */
if (mysqli_connect_errno()) {
    printf("%s: %s\n", $menerror1, $mysqli->connect_error);
    exit();
}
$email= $_POST['email'];
$email = mysqli_real_escape_string($link,$email);
$query = "SELECT NAME, EMAIL FROM " . TABLE_CONTACTPERSON.  "  WHERE EMAIL = '" .$email . "' and CONFIRMEMAIL ='1' and CONFIRMEMAILINST ='1' ";

if ($result = mysqli_query($link, $query) or die(mysql_error()) ) {

      if (mysqli_num_rows($result) == 1) {
      	//Enviar email
        while ($row = mysqli_fetch_array($result)) {
         
         $name = $row['NAME'];
         
         
      
	   }
          
          /// ENVIO  DE EMAIL

           $url1= ADDRES_SERVER."/".$_SESSION['lang']."/resetpassword".$_SESSION['lang']."/"."?email=".  $email;

          
       
             
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
				echo $l_checkemail;
			}
			else{
				echo "Fail mail";	
			}
   }
   else {
    echo  $l_emailnoencontrado;

   }
 
   /* free result set */
    mysqli_free_result($result);
}
 else {
    echo  $l_combination;
   }
 
/* close connection */
mysqli_close($link);
        
?>