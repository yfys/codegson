<?php

/*
 * Following code will list all the yf_KAREAs
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all yf_KAREAs from yf_KAREAs table
$result = mysql_query("SELECT DISTINCTROW A.ID AS ID, A.NAME AS NAME FROM yf_AREA A, yf_CONTACTPERSON B WHERE B.AREA= A.ID ") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // yf_KAREAs node
    $response["yf_AREA"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $yf_AREA = array();
        $yf_AREA["ID"] = $row["ID"];
        $yf_AREA["NAME"] = $row["NAME"];

        // push single yf_KAREA into final response array
        array_push($response["yf_AREA"], $yf_AREA);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no yf_KAREAs found
    $response["success"] = 0;
    $response["message"] = "No yf_AREAs found";

    // echo no users JSON
    echo json_encode($response);
}
?>
