<?php

session_start();


$k = array_keys($_GET);
if (isset($_GET['lang'])) { $_SESSION['lang'] = $_GET['lang']; }
if (!isset($_SESSION['lang'])) { $_SESSION['lang'] = 'en'; }

if     ($_SESSION['lang'] == 'en') { include_once("lang_en.php"); }
elseif ($_SESSION['lang'] == 'es') { include_once("lang_es.php"); }
elseif ($_SESSION['lang'] == 'pt') { include_once("lang_pt.php"); }
elseif ($_SESSION['lang'] == 'it') { include_once("lang_it.php"); }
 

/* Conexion a la base de datos para conseguir el typo*/
require_once('./databases/databasename.php');

$link = mysqli_connect(SERVERMYSQL, USER, PASS, DATABASE);

/* check connection */
if (mysqli_connect_errno()) {
    printf("%s: %s\n", $menerror1, $mysqli->connect_error);
    exit();
}

 //$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email=$_POST['email'];
$email=mysqli_real_escape_string($link,$email);
$password=$_POST['password'];
$password=mysqli_real_escape_string($link,$password);


$query = "SELECT ID, EMAIL, NAME, LASTNAME, CONFIRMEMAIL, CONFIRMEMAILINST, AREA, IDINST, PASSWORD  FROM " . TABLE_CONTACTPERSON.  "  WHERE EMAIL = '" . $email . "'";
    //. "' . "' and CONFIRMEMAIL ='1' and CONFIRMEMAILINST ='1' ";
  
   if ($result = mysqli_query($link, $query) or die(mysql_error()) ) {
   
   //Check if any row was returned. If so, fetch the name from that row
      
    if (mysqli_num_rows($result) == 1) 
    {
	   while ($row = mysqli_fetch_array($result)) {
        $passguarda= $row['PASSWORD']; 
        $passwordok= password_verify($password,$row['PASSWORD']);   
           
         $id_usuario=$row['ID']; 
         $name = $row['NAME'];
         $confirmemail=$row['CONFIRMEMAIL'];
         $confirmemail2=$row['CONFIRMEMAILINST'];
         $id_email=$row['EMAIL'];
         
      
	   }
        
        if ($confirmemail==0){
            echo $l_confirm1;
        }
        else
        {
            if ($confirmemail2==0){
                echo $l_confirm2;
            }
            else{
                if ($passwordok)
                {


                 $_SESSION['userlogin'] = $name;
                 $_SESSION['useremail']=$id_email;
                
                
                echo  " ";
                 $accionlogout= "./logout.php";
                echo $l_bienvenida."  ";
                echo $_SESSION['userlogin'] ; 
                echo "   <A target='_blank' style='color: #22aadd;text-decoration: none;background-color: transparent;font-size: 1.0625rem;box-sizing: inherit;' HREF=$accionlogout > Logout </A><BR>";
                echo "<br>";
                    /*  <a href="default.asp">
  <img src="smiley.gif" alt="HTML tutorial" style="width:42px;height:42px;border:0;">
</a>  */
               $acccionborrar=ADDRES_SERVER."/".$_SESSION['lang']."/baja".$_SESSION['lang'];
                
                echo $mensajeeliminar;    
                echo "<a target='_blank' style='color: #22aadd;text-decoration: none;background-color: transparent;font-size: 1.0625rem;box-sizing: inherit;'  href='$acccionborrar'>";
                echo $l_mensajeborrarusuario;
                echo "</a>";
                     echo "<br>";
                     echo "<br>";
                $accionbusqueda="./search.php";
                echo  $l_busquedasocios ;

                }
                else
                {
                    echo  $l_passwdwrong;
                }
            }
                
        }
        
        
       
   }
   else {
    echo  $l_combination;
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