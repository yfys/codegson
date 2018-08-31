<?php
session_start();
$k = array_keys($_GET);
if (isset($_GET['lang'])) { $_SESSION['lang'] = $_GET['lang']; }
if (!isset($_SESSION['lang'])) { $_SESSION['lang'] = 'en'; }

if     ($_SESSION['lang'] == 'en') { include_once("lang_en.php"); }
elseif ($_SESSION['lang'] == 'es') { include_once("lang_es.php"); }
elseif ($_SESSION['lang'] == 'pt') { include_once("lang_pt.php"); }
elseif ($_SESSION['lang'] == 'it') { include_once("lang_it.php"); }


unset($_SESSION['userlogin']);
unset($_SESSION['useremail']);
require_once('./databases/databasename.php');
$accion = "Location:".ADDRES_SERVER.$HTTP_REFERER;

header($accion);
 
 ?>