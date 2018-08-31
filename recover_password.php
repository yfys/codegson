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
 $direccionServer= ADDRES_SERVERFUTURE."/send_recover.php";

echo "<form action='$direccionServer' method='POST'>";
echo  "<h1>$l_recuperacion</h1><br>";

echo  "<table>";

echo "<tr>";

echo "<td>";
echo $l_lemailregister;
echo "</td>";

echo "<td>";
echo  "<input type='text' name='email' placeholder='$l_lemailregisterf'><br>";
echo "</td>";

echo "</tr>";

echo "</table>";

echo "<br>";
echo  "<input type='submit' value='$l_buttomsubmit' style='text-decoration: none;  padding: 10px;   font-weight: 600;     font-size: 20px;     color: #ffffff;
    background-color: #1883ba;     border-radius: 6px;     border: 2px solid #0016b0;'>";

?>