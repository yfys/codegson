
<?php
session_start();


$k = array_keys($_GET);
if (isset($_GET['lang'])) { $_SESSION['lang'] = $_GET['lang']; }
if (!isset($_SESSION['lang'])) { $_SESSION['lang'] = 'en'; }

if     ($_SESSION['lang'] == 'en') { include_once("lang_en.php"); }
elseif ($_SESSION['lang'] == 'es') { include_once("lang_es.php"); }
elseif ($_SESSION['lang'] == 'pt') { include_once("lang_pt.php"); }
elseif ($_SESSION['lang'] == 'it') { include_once("lang_it.php"); }
   ini_set( 'display_errors', 1 );
   error_reporting( E_ALL );
    $error=0;
 
//	$idinst =$_GET['idinst'];
    $idper = $_GET['idper'];

 

if (isset($idper)){
    
      require_once('./databases/databasename.php');
     
        $mysqli = new mysqli(SERVERMYSQL, USER, PASS, DATABASE);
      
        if (mysqli_connect_errno()) {
            printf("%s: %s\n", $menerror1,  mysqli_connect_error());
            exit();
        }

        $idper=mysqli_real_escape_string($mysqli,$idper);
  
        $update= "UPDATE "  .  TABLE_CONTACTPERSON ." SET CONFIRMEMAILINST=1, CONFIRMEMAIL=1 WHERE ID=".$idper; 
  
     
        mysqli_query($mysqli, $update);

  
        mysqli_close($mysqli);
        echo $registerendpe;
    
}
   else
    {
    	  
	   echo $menerror5;
	   $error=1;
    }  




?>