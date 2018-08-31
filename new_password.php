<!DOCTYPE html>
<html>
<head>
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
</head>
<body>
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
 $direccionServer= ADDRES_SERVER."/yourfuture/update_password.php";

if(isset($_GET['email'])){

	$email = $_GET['email'];

	echo "<form action='$direccionServer' method='POST'>";
	echo  "<h1>$l_contrasena</h1><br>";

	echo  "<table>";

	echo "<tr>";

	echo "<td>";
	echo  "<input type='email' name='email' hidden value='$email'><br>";
	echo "</td>";

	echo "</tr>";


	echo "<tr>";

	echo "<td>";
    echo $l_passwordinsti;
	
	echo "</td>";

	echo "<td>";
	echo  "<input type='email' name='emailcenter' placeholder='$l_emailcenterf' ><br>";
	echo "</td>";

	echo "</tr>";

    echo "<tr>";

	echo "<td>";
	echo $l_password;
	echo "</td>";

	echo "<td>";
	echo  "<input type='password' name='password' placeholder='$l_passwordf' id='password1' ><br>";
	echo "</td>";

	echo "</tr>";

	echo "<tr>";

	echo "<td>";
	echo $l_confirmarcontrasena;
	echo "</td>";

	echo "<td>";
	echo  "<input type='password' name='password2' placeholder='$l_passwordf' id='password2'><br>";
	echo "</td>";

	echo "</tr>";

	echo "</table>";

	echo "<br>";
	echo  "<input type='submit' value='$l_buttomsubmit' style='text-decoration: none;  padding: 10px;   font-weight: 600;     font-size: 20px;     color: #ffffff;
    background-color: #1883ba;     border-radius: 6px;     border: 2px solid #0016b0;'  onClick='return compara();'>";

	echo "</form>";

}else{
	echo $l_datosget;
}


?>
</body>
</html>

