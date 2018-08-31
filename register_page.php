<?php
   // ini_set( 'display_errors', 1 );
 //    error_reporting( E_ALL );

session_start();
$k = array_keys($_GET);
if (isset($_GET['lang'])) { $_SESSION['lang'] = $_GET['lang']; }
if (!isset($_SESSION['lang'])) { $_SESSION['lang'] = 'en'; }

if     ($_SESSION['lang'] == 'en') { include_once("lang_en.php"); }
elseif ($_SESSION['lang'] == 'es') { include_once("lang_es.php"); }
elseif ($_SESSION['lang'] == 'pt') { include_once("lang_pt.php"); }
elseif ($_SESSION['lang'] == 'it') { include_once("lang_it.php"); }


 
//// grab recaptcha library
include_once('recaptchalib.php');


//Multiple asignacion de valores pasandolas por mysql real escape para evitar la inyeccion de código.

$confirmemailinst=0;
$numero = count($_POST);
$tags = array_keys($_POST); // obtiene los nombres de las varibles
$valores = array_values($_POST);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
for($i=0;$i<$numero;$i++){ 
$$tags[$i]=$valores[$i]; 

 //echo "<p> <b>".$tags[$i]." </b>=".$valores[$i]."</p>";
}

//////////////////////////////////////////////////////////
/*  COMPROBACION CAPTCHA  *******************************/
 

// your secret key
$secret = "6LeARzgUAAAAACb_xBUz1o1vnbxYOr2xNv4d-3TO";
 
// empty response
$response = null;


$captcha=$_POST["g-recaptcha-response"];



$urlgoogle= "https://www.google.com/recaptcha/api/siteverify";

$mensajegoogle=$urlgoogle."?secret=".$secret."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR'];

 



if ($_POST["g-recaptcha-response"]) {
 
     

    $jsondata=curl_init($mensajegoogle);

    curl_setopt($jsondata,CURLOPT_RETURNTRANSFER, TRUE);
    $jsondata = curl_exec($jsondata);

    $getGoogle = json_decode($jsondata,true);

    $resultado = $getGoogle['success'];
      
      
 
  
}
else
{
  
   echo $l_mustcaptcha;
   exit();
}



 $confirmemailinst=0;

if ($resultado!=null){

      if ($resultado) {
          
          if (strcmp($condition,"1")==0){
              /////////////INSERTAR
              

        //////////////////////////INSERTAR

         
          /* Conexion a la base de datos */
          require_once('./databases/databasename.php');

          $mysqli = new mysqli(SERVERMYSQL, USER, PASS, DATABASE);



          /* check connection */
          if (mysqli_connect_errno()) {
              printf("%s: %s\n", $menerror1,  mysqli_connect_error());
              exit();
          }
          //check if institution exists
          $emailcenter=mysqli_real_escape_string($mysqli,$emailcenter);
      
            $namecenter=mysqli_real_escape_string($mysqli,$namecenter);
     
            $street = mysqli_real_escape_string($mysqli,$street);

            $city =mysqli_real_escape_string($mysqli,$city);

            $country =mysqli_real_escape_string($mysqli,$country);

            $emailcenter=mysqli_real_escape_string($mysqli,$emailcenter);

            $type=mysqli_real_escape_string($mysqli,$type);


        
 
          //check if persons exists
          $email=mysqli_real_escape_string($mysqli,$email);

          $query = "SELECT ID  FROM ". TABLE_CONTACTPERSON ." WHERE EMAIL  = '" . $email. "'";
           
          $resultado= mysqli_query($mysqli,$query);

          $row_cnt = mysqli_num_rows($resultado);
          
          $row = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

          if ( $row_cnt >=1 ){
            // 
            echo $l_peopleregister;
            echo "<br>";
            $idperson = $row["ID"];
            $confirmemailpeople=1;
          }
          else {
            //Guardamos los datos de la persona
      

              $name=mysqli_real_escape_string($mysqli,$name);
       
              $lastname = mysqli_real_escape_string($mysqli,$lastname);

              $email =mysqli_real_escape_string($mysqli,$email);

              $password =mysqli_real_escape_string($mysqli,$password1);

              $password = password_hash($password, PASSWORD_DEFAULT);

              $emailcenter=mysqli_real_escape_string($mysqli,$emailcenter);

              $area=mysqli_real_escape_string($mysqli,$area);

             // inseramos institucion  
            $insertinsti= "INSERT " . TABLE_INSTITUTION.  " (EMAIL, NAME, STREET, CITY, COUNTRY, TYPE)  VALUES ('$emailcenter', '$namecenter','$street', '$city','$country',$type)";

             

            mysqli_query($mysqli, $insertinsti);

            $idinst = mysqli_insert_id($mysqli);
              
              // insertamos la persona

              $insert= "INSERT " . TABLE_CONTACTPERSON.  " (EMAIL, NAME, LASTNAME, CONFIRMEMAIL, CONFIRMEMAILINST, AREA, PASSWORD, IDINST)  VALUES ('$email','$name', '$lastname',0, $confirmemailinst,$area,'$password',$idinst)";

              


               mysqli_query($mysqli, $insert);

              $idperson = mysqli_insert_id($mysqli);
              
              

            $nameproject=mysqli_real_escape_string($mysqli,$nameproject);
     
            $ktype = mysqli_real_escape_string($mysqli,$ktype);

            

            $insert= "INSERT " . TABLE_PROJECT .  " ( NAME, IDCONTACT, KTYPE)  VALUES ('$nameproject',$idperson,$ktype)";

            mysqli_query($mysqli, $insert);

            $idproyect = mysqli_insert_id($mysqli);

             mysqli_free_result($resultado);


            mysqli_close($mysqli);
 


          $url1= ADDRES_SERVER."/" .$_SESSION['lang']."/endregister".$_SESSION['lang']."?idinst=".   urlencode( $idinst."#".md5($idinst));
              $persona=urlencode($idperson."#".md5($idperson));
            $url1=$url1."&idper=".$persona;
              
         
            
            
            $url2= ADDRES_SERVER."/" .$_SESSION['lang']."/endregister".$_SESSION['lang']."?idper=". urlencode($idperson."#".md5($idperson));  
 
                         
              
             
              require_once('emailregistro.php');
              
           $mensajepainsti=$variablecabeza1 .$l_saludo .$name.$variablecabeza2. $l_mensaemail1.$variablecuerpo1.$l_mensaemail2. $variablecuerpo2. $l_mensaemail3.$variablecuerpo3.$variablecuerpo4.$url1.$variablecuerpo5.$l_mensaemail4.$variablecuerpo6.$l_mensaemail5.$variablecuerpo7.$l_mensaemail6.$variablecuerpo8.$variablepie1.$variablepie2;
              
   
              
          $mensaje2=$variablecabeza1 .$l_saludo .$name.$variablecabeza2. $l_mensaemail1.$variablecuerpo1.$l_mensaemail2. $variablecuerpo2. $l_mensaemail3.$variablecuerpo3.$variablecuerpo4.$url2.$variablecuerpo5.$l_mensaemail4.$variablecuerpo6.$l_mensaemail5.$variablecuerpo7.$l_mensaemail6.$variablecuerpo8.$variablepie1.$variablepie2;
        
              //Enviamos email a la institucion
            /*  
              $from      = $emailcenter;
              $titulo    = $l_mensaemail1;
              $mensaje   = $mensajepainsti;
              
              $cabeceras = 'From: noreply@yfys.eu' . "\r\n" ;
              $cabeceras .= "MIME-Version: 1.0" . "\r\n";
              $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              
              mail($from, $titulo, $mensaje, $cabeceras);

 */

              //Enviamos email a la persona de contacto
          
              $from      = $email;
              $titulo    = $l_mensaemail1;
              $mensaje   = $mensaje2;
              $cabeceras = 'From: noreply@yfys.eu' . "\r\n" ;
              $cabeceras .= "MIME-Version: 1.0" . "\r\n";
              $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              mail($from, $titulo, $mensaje, $cabeceras);
        

        // Informamos de los pasos 

        echo $info1;
            echo "<br>";
        echo $info2;



          }


 


        ///////////////////////////FIN INSERTAR
              

          }
          else{ //DEBE ACEPTAR LAS CONDICIONES
              
              echo $menerror4;
              
          }

       

      }
      else {
        echo "ROBOT";  
        echo $_robot;
         } 
}

 else
 {
       // wrong captcha CADUCADO
  echo $l_capchadied;
     echo "FALLO CATPCHA";
 }






 
?>