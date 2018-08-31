<?php

session_start();


$k = array_keys($_GET);
if (isset($_GET['lang'])) { $_SESSION['lang'] = $_GET['lang']; }
if (!isset($_SESSION['lang'])) { $_SESSION['lang'] = 'en'; }

if     ($_SESSION['lang'] == 'en') { include_once("lang_en.php"); }
elseif ($_SESSION['lang'] == 'es') { include_once("lang_es.php"); }
elseif ($_SESSION['lang'] == 'pt') { include_once("lang_pt.php"); }
elseif ($_SESSION['lang'] == 'it') { include_once("lang_it.php"); }

  

$sendemail = $_POST['idpersona'];
$contenido=  $_POST['escritura'];
$acceptado=  $_POST['accept'];
        $country=$_POST['country'];
     $area=$_POST['area'];
     $ktype=$_POST['ktype'];
     $type=$_POST['type'];

//$numero = count($_POST);
//$tags = array_keys($_POST); // obtiene los nombres de las varibles
//$valores = array_values($_POST);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
//for($i=0;$i<$numero;$i++){ 
// $$tags[$i]=$valores[$i]; 



   $accionlogout= "./logout.php";
    echo $l_bienvenida."  ";
    echo $_SESSION['userlogin'] ; 
    echo "   <A target='_blank' style='color: #22aadd;text-decoration: none;background-color: transparent;font-size: 1.0625rem;box-sizing: inherit;' HREF=$accionlogout >".Logout. "</A><BR>";


if (strcmp($acceptado,"1")==0)
{
	// aqui hay que hacer una consulta con el dato de la sesion
	//obtner con el id y el email del dueño de la sesion
    
    $emailpersonal= $_SESSION['useremail'];

   
}
else
     $emailpersonal="";
    
$email="From: noreply@yfys.eu";

 /* Conexion a la base de datos */


          require_once('./databases/databasename.php');

          $mysqli = new mysqli(SERVERMYSQL, USER, PASS, DATABASE);



          /* check connection */
          if (mysqli_connect_errno()) {
              printf("%s: %s\n", $menerror1,  mysqli_connect_error());
              exit();
          }
           
          
          $idper =mysqli_real_escape_string($mysqli,$idper);

          $query = "SELECT ID, EMAIL , NAME  FROM ".  TABLE_CONTACTPERSON ." WHERE ID  = '" . $sendemail. "'";
          

          //  echo $query;
       
            
          $resultado= mysqli_query($mysqli,$query);
  
          

      
             while ($row = mysqli_fetch_row($resultado)) {
                     
              $from      = $row[1];
              $name      = $row[2];
            
 
                }


 
            
       
 
            $url= $contenido ."  ".$emailpersonal;
              
             
              require_once('emailenvio.php');
              
           $mensajepart=$variablecabeza1 .$l_saludo .$name.$variablecabeza2. $l_mensaemailsend1.$variablecuerpo1.$l_mensaemailsend2. $variablecuerpo2. $l_mensaemailsend3.$variablecuerpo3.$url.$variablecuerpo6.$l_mensaemail5.$variablecuerpo7.$l_mensaemail6.$variablecuerpo8.$variablepie1.$variablepie2;
              

          //  echo $mensajepart;

     
              $from      = $from;
              $titulo    = $l_mensaemailsend1;
              $mensaje   = $mensajepart;
              $cabeceras = 'From: noreply@yfys.eu' . "\r\n" ;
              $cabeceras .= "MIME-Version: 1.0" . "\r\n";
              $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              mail($from, $titulo, $mensaje, $cabeceras);
        




     		mysqli_close($mysqli);

 
              echo  $mensaemailsend4;



        $accionservidor= ADDRES_SERVERFUTURE."/lookfor_page.php";
        
echo "<form action='$accionservidor' method='GET'>";

/***NUEVO*****/
echo "<input  type='hidden' name='country' value=". $country." >";
echo "<input  type='hidden' name='type' value=". $type." >";
echo "<input  type='hidden' name='ktype' value=". $ktype." >";
echo "<input  type='hidden' name='area' value=". $area." >";

/***NUEVO*****/
  echo "<br>"; 
     
echo  "<input type='submit' name='buscardenuevo' value='$l_buttomsubmitsearch'     style='text-decoration: none;  padding: 10px;   font-weight: 600;     font-size: 20px;     color: #ffffff;
    background-color: #1883ba;     border-radius: 6px;     border: 2px solid #0016b0;' >";
         
echo "</form>";


?>
 