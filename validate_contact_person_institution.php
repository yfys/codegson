<?php

/*
 * Following code will get single yf_CONTACTPERSON details
 * A yf_CONTACTPERSON is identified by yf_CONTACTPERSON id (pid)
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// check for post data
if (isset($_GET["pid"])) {
    $pid = $_GET['pid'];

    // get a yf_CONTACTPERSON from yf_CONTACTPERSONs table
    $result = mysql_query("UPDATE yf_CONTACTPERSON SET CONFIRMEMAILINST = 1 WHERE ID = $pid");

    if ($result) {
        // successfully inserted into database
        echo "Validado";
		echo"<br />";

        
    } else {
        // failed to insert row
        echo "El usuario no ha podido validarse";
		echo"<br />";
        
    }
} else {
    // required field is missing
    echo "Faltan datos";
	echo"<br />";

}
?>