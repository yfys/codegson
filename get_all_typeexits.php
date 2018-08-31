<?php

/*
 * Following code will list all the yf_KTYPEs
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all yf_KTYPEs from yf_KTYPEs table
$result = mysql_query("SELECT DISTINCTROW A.ID AS ID, A.NAME AS NAME FROM yf_TYPE A, yf_INSTITUTION B WHERE B.TYPE= A.ID") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // yf_KTYPEs node
    $response["yf_TYPE"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $yf_KTYPE = array();
        $yf_KTYPE["ID"] = $row["ID"];
        $yf_KTYPE["NAME"] = $row["NAME"];

        // push single yf_KTYPE into final response array
        array_push($response["yf_TYPE"], $yf_KTYPE);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no yf_KTYPEs found
    $response["success"] = 0;
    $response["message"] = "No yf_KTYPEs found";

    // echo no users JSON
    echo json_encode($response);
}
?>
