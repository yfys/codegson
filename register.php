<!DOCTYPE html>
<html>

 
<!-- JavaScript -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script type="text/javascript">
    
   
    
    function compara(){
        var password = document.getElementById("password1");
        var confirm_password = document.getElementById("password2");
      
        
         
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
}
    
   

    

</script>
 
<?php
session_start();

$k = array_keys($_GET);
if (isset($_GET['lang'])) { $_SESSION['lang'] = $_GET['lang']; }
if (!isset($_SESSION['lang'])) { $_SESSION['lang'] = 'en'; }

if     ($_SESSION['lang'] == 'en') { include_once("lang_en.php"); }
elseif ($_SESSION['lang'] == 'es') { include_once("lang_es.php"); }
elseif ($_SESSION['lang'] == 'pt') { include_once("lang_pt.php"); }
elseif ($_SESSION['lang'] == 'it') { include_once("lang_it.php"); }
 
require_once('./databases/databasename.php');
$accionservidor= ADDRES_SERVER."/yourfuture/register_page.php";

$linkmanual="https://yfys.eu/".$_SESSION['lang'] ."/manual".$_SESSION['lang'] ."/";


if (!isset($_SESSION['useremail'])){   
    
echo "<form id='formulario' name='formulario' action='$accionservidor' method='POST'>";
echo "<h1> $l_datacenter ";
echo "<a target='_blank' href='".$linkmanual."'>";
echo "<img src='./images/informationpeq.png' alt='MANUAL' style='width:25px;height:25px;border:0'>";
echo "</a>";
echo "</h1><br>";
echo "<table style='width:100%'>";
echo "<tr>";
echo "<td>";

echo $l_namecenter;
echo "</td>";
echo "<td>";
echo "<input type='text' name='namecenter' placeholder='$l_namecenterf' id ='namecenter' required pattern='[0-9A-Za-z ‘#\.-]{3,70}'  title='$l_mensajename' ><br>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";

echo $l_street;
echo "</td>";
echo "<td>";
echo "<input type='text' name='street' placeholder='$l_streetf' id='street' required pattern='[0-9A-Za-z ,‘#\.-]{3,100}'  title='$l_mensajename' ><br>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";

echo $l_city;
echo "</td>";
echo "<td>";
echo "<input type='text' id='city' name='city' placeholder='$l_cityf' required pattern='[0-9A-Za-z ,‘#\.-]{3,100}'  title='$l_mensajename'  ><br>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";

echo $l_country;
echo "</td>";
echo "<td>";
require_once('./country.php');
echo "<select name='country' id='country' >";
foreach ($paises as $key => $value) {
     printf ("<option value=%s>%s</option>" , $value, $value);
}
echo "</select> <br>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";

echo  $l_emailcenter;
echo "</td>";
echo "<td>";
echo "<input type='email' name='emailcenter' placeholder='$l_emailcenterf' required id='emailcenter' ><br>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";

/* Conexión a la base de datos para conseguir el typo */
require_once('./databases/databasename.php');

$link = mysqli_connect(SERVERMYSQL, USER, PASS, DATABASE);

/* check connection */
if (mysqli_connect_errno()) {
    printf("%s: %s\n", $menerror1, $mysqli->connect_error);
    exit();
}

$query = "SELECT ID, NAME FROM yf_TYPE";

echo $l_type;
echo "</td>";
echo "<td>";
echo "<select name='type'>";
if ($result = mysqli_query($link, $query)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {
        printf ("<option value=%s>%s</option>" , $row[0], $row[1]);
    }

    /* free result set */
    mysqli_free_result($result);
}
echo  "</select>";
/* close connection */
mysqli_close($link);
echo "</td>";
echo "</tr>";
/*
    echo "<tr>";
   
echo "<td>";

echo $l_picnumber;
echo "</td>";
echo "<td>";
echo "<input type='text' id='pic' name='pic' placeholder='$l_picnumber' required pattern='[0-9]{3,10}'  title='$l_mensajepic' ><br>";
echo "</td>";
echo "</tr>";
*/
echo "</table>";
echo "<h1> $l_datapersonal";
    echo "<a target='_blank' href='".$linkmanual."'>";
echo "<img src='./images/informationpeq.png' alt='MANUAL' style='width:25px;height:25px;border:0'>";
echo "</a>";
echo "</h1><br>";
echo "<table style='width:100%'>";
echo "<tr>";
echo "<td>";

echo $l_namepersonal;
echo "</td>";
echo "<td>";
echo "<input type='text' id='name' name='name' placeholder='$l_namepersonalf' required pattern='[0-9A-Za-z ‘#\.-]{3,70}'  title='$l_mensajename' ><br>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";

echo $l_lastname;
echo "</td>";
echo "<td>";
echo "<input type='text' id='lastname' name='lastname' placeholder='$l_lastnamef' required pattern='[0-9A-Za-z ‘#\.-]{3,100}'  title='$l_mensajename' ><br>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";

echo $l_email;
echo "</td>";
echo "<td>";
echo "<input type='email' id='email' name='email' placeholder='$l_emailf' required><br>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";

echo $l_password;
echo "</td>";
echo "<td>";
echo "<input type='password' name='password1' placeholder='$l_passwordf' id='password1'><br>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";

echo $l_passwordagain;
echo "</td>";
echo "<td>";
echo "<input type='password' name='password2' placeholder='$l_passwordagainf' id='password2'><br>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";

//area de trabajo

/* Conexion a la base de datos para conseguir el area*/
require_once('./databases/databasename.php');

$link = mysqli_connect(SERVERMYSQL, USER, PASS, DATABASE);

/* check connection */
if (mysqli_connect_errno()) {
    printf("%s: %s\n", $menerror1, $mysqli->connect_error);
    exit();
}

$query = "SELECT ID, NAME   FROM yf_AREA";

echo $l_area;
echo "</td>";
echo "<td>";
echo "<select name='area'>";
if ($result = mysqli_query($link, $query)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {
        printf ("<option value=%s>%s</option>" , $row[0], $row[1]);
    }

    /* free result set */
    mysqli_free_result($result);
}
echo "</select>";
echo "</td>";
echo "</tr>";
/* close connection */
mysqli_close($link);
    
echo "<tr>";
echo "<td>";

/* Conexion a la base de datos para conseguir el typo*/
require_once('./databases/databasename.php');

$link = mysqli_connect(SERVERMYSQL, USER, PASS, DATABASE);

/* check connection */
if (mysqli_connect_errno()) {
    printf("%s: %s\n", $menerror1, $mysqli->connect_error);
    exit();
}

$query = "SELECT ID, KTYPENAME   FROM yf_KTYPE";

echo $l_ktype;
echo "</td>";
echo "<td>";
echo "<select name='ktype'>";
if ($result = mysqli_query($link, $query)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {
        printf ("<option value=%s>%s</option>" , $row[0], $row[1]);
    }
    
    /* free result set */
    mysqli_free_result($result);
}
echo  "</select>";
/* close connection */
mysqli_close($link);
echo "</td>";
echo "</tr>";
    
echo "</table>";

echo "<h1> $l_project";
echo "<a target='_blank' href='".$linkmanual."'>";
echo "<img src='./images/informationpeq.png' alt='MANUAL' style='width:25px;height:25px;border:0'>";
echo "</a>";
echo "</h1><br>";
echo "<table style='width:100%'>";
echo "<tr>";
echo "<td>";

echo $l_nameproject. "(".$mensaje1.")";
echo "</td>";
echo "<td>";
echo "<input type='text' id='nameproject' name='nameproject' placeholder='$l_nameprojectf'   pattern='[0-9A-Za-z ‘#\.-]{0,100}'  title='$l_mensajename' ><br>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<input type='checkbox'  name='condition' id='condition'  value='1'>"; 
 
echo  $l_condition; 

$enlace_condicion= ADDRES_SERVER."/".$_SESSION['lang']."/condiciones".$_SESSION['lang'];     
echo "<a target='_blank' style='color: #22aadd;text-decoration: none;background-color: transparent;font-size: 1.0625rem;box-sizing: inherit;' href='$enlace_condicion'>".$condiciones."</a>";
echo "</td>";
echo "</tr>";
echo "</table>";

//Añadirle el captcha 
echo "<div class='g-recaptcha' data-sitekey='6LeARzgUAAAAAB269t0Ac3Waa31oqNY1Jy2cwPSA'></div>";
echo "<br>";
echo "<input type='submit' name='guardar' value='$l_buttomsubmit' style='text-decoration: none;  padding: 10px;   font-weight: 600;     font-size: 20px;     color: #ffffff;
    background-color: #1883ba;     border-radius: 6px;     border: 2px solid #0016b0;' onClick='return compara();'  >";

//echo  "<input type='submit' name='guardar' value='$l_buttomsubmit'  >";
echo "<br>";
echo "<br>";
echo "</form>";
}
    else
    {
         echo  " ";
                 $accionlogout= "./logout.php";
                echo $l_bienvenida."  ";
                echo $_SESSION['userlogin'] ; 
                echo "   <A target='_blank' style='color: #22aadd;text-decoration: none;background-color: transparent;font-size: 1.0625rem;box-sizing: inherit;' HREF=$accionlogout > Logout </A><BR>";
                echo "<br>";
                echo $l_salgasistema;
        
    }
?>

 