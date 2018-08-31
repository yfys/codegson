<?php

session_start();


$k = array_keys($_GET);
if (isset($_GET['lang'])) { $_SESSION['lang'] = $_GET['lang']; }
if (!isset($_SESSION['lang'])) { $_SESSION['lang'] = 'en'; }

if     ($_SESSION['lang'] == 'en') { include_once("lang_en.php"); }
elseif ($_SESSION['lang'] == 'es') { include_once("lang_es.php"); }
elseif ($_SESSION['lang'] == 'pt') { include_once("lang_pt.php"); }
elseif ($_SESSION['lang'] == 'it') { include_once("lang_it.php"); }

  

$idper = $_POST['idpersona'];
$country=$_POST['country'];
$area=$_POST['area'];
$ktype=$_POST['ktype'];
$type=$_POST['type'];



$pais=$_POST['pais'];
$centro=$_POST['centro'];
$contacto=$_POST['contacto'];
$tipocentro=$_POST['tipocentro'];
$areac=$_POST['areac'];
$tipoproyecto=$_POST['tipoproyecto'];

require_once('./databases/databasename.php');

   $accionlogout= "./logout.php";
    echo $l_bienvenida."  ";
    echo $_SESSION['userlogin'] ; 
     echo "   <A target='_blank' style='color: #22aadd;text-decoration: none;background-color: transparent;font-size: 1.0625rem;box-sizing: inherit;' HREF=$accionlogout >".Logout. "</A><BR>";
   $accionservidor= ADDRES_SERVERFUTURE."/sendemail.php";


/**/
 
echo "<table style='width:100%;border:1px solid black;border-collapse: collapse;' >";
echo "<tr style='border: 1px solid black;border-collapse: collapse;'>";
echo  "<th colspan='2'>".$l_personadestino."</th>";  
echo "</tr>";
echo "<tr>";
echo "<td style= 'border:1px solid black;border-collapse: collapse;padding: 5px;text-align: left;'> <b>".$l_country."</b></td>";
 
 echo "<td style= 'border:1px solid black;border-collapse: collapse;padding: 5px;text-align: left;'> ".$pais."</td>";
echo "</tr>";
echo "<tr>";
echo "<td style= 'border:1px solid black;border-collapse: collapse;padding: 5px;text-align: left;'> <b>".$l_namecenter."</b></td>";
 
echo "<td style= 'border:1px solid black;border-collapse: collapse;padding: 5px;text-align: left;'> ".$centro."</td>";
echo "</tr>";
echo "<tr>";   
echo "<td style= 'border:1px solid black;border-collapse: collapse;padding: 5px;text-align: left;'> <b>".$l_namepersonal."</b></td>";
 
echo "<td style= 'border:1px solid black;border-collapse: collapse;padding: 5px;text-align: left;'> ".$contacto."</td>";
echo "</tr>";
echo "<tr>";
echo "<td style= 'border:1px solid black;border-collapse: collapse;padding: 5px;text-align: left;'> <b>".$l_type."</b></td>";
 
echo "<td style= 'border:1px solid black;border-collapse: collapse;padding: 5px;text-align: left;'> ".$tipocentro."</td>";
echo "</tr>";
echo "<tr>";
   echo "<td style= 'border:1px solid black;border-collapse: collapse;padding: 5px;text-align: left;'> <b>".$l_area."</b></td>";
 
echo "<td style= 'border:1px solid black;border-collapse: collapse;padding: 5px;text-align: left;'> ".$area."</td>";
echo "</tr>";
echo "<tr>";   
echo "<td style= 'border:1px solid black;border-collapse: collapse;padding: 5px;text-align: left;'> <b>".$l_ktype."</b></td>";
 
echo "<td style= 'border:1px solid black;border-collapse: collapse;padding: 5px;text-align: left;'>".$tipoproyecto."</td>";
echo "  </tr>";
echo "</table>";

/**/
echo "<form action='$accionservidor' method='POST'>";
echo  "<h1>  $emailinfo </h1><br>";
echo "<input  type='hidden' name='idpersona' value=". $idper." >";
/***NUEVO*****/
echo "<input  type='hidden' name='country' value=". $country." >";
echo "<input  type='hidden' name='type' value=". $type." >";
echo "<input  type='hidden' name='ktype' value=". $ktype." >";
echo "<input  type='hidden' name='area' value=". $area." >";

/***NUEVO*****/
echo "<br>";
echo  $mensaemail3;
echo "<textarea rows='10' cols='100' name='escritura' required  placeholder=". $l_textoemail .">";
echo "</textarea>";
echo "<br>";
echo "<input type='checkbox' name='accept' value=1>".$mensaemail4 ; 
echo "<br>";
 
echo "<br>";
echo  "<input type='submit' value='$l_buttomsubmit2' style='text-decoration: none;  padding: 10px;   font-weight: 600;     font-size: 20px;     color: #ffffff;
    background-color: #1883ba;     border-radius: 6px;     border: 2px solid #0016b0;' >";
echo "</form>";

?>
