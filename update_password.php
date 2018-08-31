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

 $numero = count($_POST);
 $tags = array_keys($_POST); // obtiene los nombres de las varibles 
 $valores = array_values($_POST);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
for($i=0;$i<$numero;$i++){ 
$$tags[$i]=$valores[$i]; 

}
include('./databases/databasename.php');
$link = mysqli_connect(SERVERMYSQL, USER, PASS, DATABASE);

/* check connection */
if (mysqli_connect_errno()) {
    printf("%s: %s\n", $menerror1, $mysqli->connect_error);
    exit();
}


 $password =mysqli_real_escape_string($link,$password);
 $password = password_hash($password, PASSWORD_DEFAULT);
 $emailcenter=mysqli_real_escape_string($link,$emailcenter);

$query = "SELECT * FROM ".TABLE_CONTACTPERSON."  A , ".TABLE_INSTITUTION." B WHERE A.IDINST=B.ID AND B.EMAIL= '".$emailcenter."' AND A.EMAIL ='".$email."'";



  if ($result = mysqli_query($link, $query) or die(mysql_error()) ) {
    if (mysqli_num_rows($result) == 1) 
       {
    
      $query = "UPDATE ".TABLE_CONTACTPERSON." SET PASSWORD = '". $password ."' WHERE EMAIL = '".$email."'";

        if($result = mysqli_query($link, $query) or die (mysql_error()) ){
	       echo $l_contrasenaactualizada;
    
            }else{
	           echo $l_menerror1;
   
                }
    }
      else
          echo $l_menerror1;
}  
else
 echo $l_menerror1;
  






?>