<?php

session_start();


$k = array_keys($_GET);
if (isset($_GET['lang'])) { $_SESSION['lang'] = $_GET['lang']; }
if (!isset($_SESSION['lang'])) { $_SESSION['lang'] = 'en'; }

if     ($_SESSION['lang'] == 'en') { include_once("lang_en.php"); }
elseif ($_SESSION['lang'] == 'es') { include_once("lang_es.php"); }
elseif ($_SESSION['lang'] == 'pt') { include_once("lang_pt.php"); }
elseif ($_SESSION['lang'] == 'it') { include_once("lang_it.php"); }

include('./databases/databasename.php');
 $direccionServer= ADDRES_SERVERFUTURE."/login_page.php";

if (!isset($_SESSION['useremail']))
{
echo "<form action='$direccionServer' method='POST'>";
 

echo  "<table>";

echo "<tr>";

echo "<td>";
echo $l_lemailregister;
echo "</td>";

echo "<td>";
echo  "<input type='text' name='email' placeholder='$l_lemailregisterf'><br>";
echo "</td>";

echo "</tr>";

echo "<tr>";

echo "<td>";
echo $l_password;
echo "</td>";

echo "<td>";
echo  "<input type='password' name='password' placeholder='$l_passwordf'><br>";
echo "</td>";

echo "</tr>";

echo "</table>";

echo "<br>";
echo  "<input type='submit' value='$l_buttomsubmit'  style='text-decoration: none;  padding: 10px;   font-weight: 600;     font-size: 20px;     color: #ffffff;
    background-color: #1883ba;     border-radius: 6px;     border: 2px solid #0016b0;' >";
echo "<br>";
echo "<br>";
echo "</form>";

 $direccionPassword = ADDRES_SERVER."/yourfuture/recover_password.php";

 

echo "<a  href='$direccionPassword' style='color: #22aadd;text-decoration: none;background-color: transparent;font-size: 1.0625rem;box-sizing: inherit;'>";
echo $l_recuperarcontrasena;
echo "</a>";

}
else
{
     
                
                
                echo  " ";
                 $accionlogout= "./logout.php";
                echo $l_bienvenida."  ";
                echo $_SESSION['userlogin'] ; 
                echo "   <A target='_blank' style='color: #22aadd;text-decoration: none;background-color: transparent;font-size: 1.0625rem;box-sizing: inherit;' HREF=$accionlogout >".Logout. "</A><BR>";
                echo "<br>";
                $acccionborrar=ADDRES_SERVER."/".$_SESSION['lang']."/baja".$_SESSION['lang'];
                
                 
    
               echo $mensajeeliminar;    
                echo "<a target='_blank' style='color: #22aadd;text-decoration: none;background-color: transparent;font-size: 1.0625rem;box-sizing: inherit;'  href='$acccionborrar'>";
                echo $l_mensajeborrarusuario;
                echo "</a>";
                     echo "<br>";
                     echo "<br>";
}

?>


