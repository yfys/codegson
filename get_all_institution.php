<?php

/*
 * Following code will list all the yf_KINSTITUTIONs
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all yf_INSTITUTIONs from yf_KINSTITUTIONs table
$result = mysql_query("SELECT * FROM yf_INSTITUTION") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // yf_INSTITUTIONs node
    $response["yf_INSTITUTION"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $yf_INSTITUTION = array();
        $yf_INSTITUTION["ID"] = $row["ID"];
		$yf_INSTITUTION["EMAIL"] = $row["EMAIL"];
        $yf_INSTITUTION["NAME"] = $row["NAME"];
		$yf_INSTITUTION["STREET"] = $row["STREET"];
		$yf_INSTITUTION["CITY"] = $row["CITY"];
		$yf_INSTITUTION["COUNTRY"] = $row["COUNTRY"];
		$yf_INSTITUTION["TYPE"] = $row["TYPE"];

        // push single yf_KINSTITUTION into final response array
        array_push($response["yf_INSTITUTION"], $yf_INSTITUTION);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no yf_INSTITUTIONs found
    $response["success"] = 0;
    $response["message"] = "No yf_INSTITUTIONs found";

    // echo no users JSON
    echo json_encode($response);
}
?>
