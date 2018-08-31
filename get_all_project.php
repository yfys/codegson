<?php

/*
 * Following code will list all the yf_KPROJECTs
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all yf_PROJECTs from yf_KPROJECTs table
$result = mysql_query("SELECT * FROM yf_PROJECT") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // yf_PROJECTs node
    $response["yf_PROJECT"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $yf_PROJECT = array();
        $yf_PROJECT["ID"] = $row["ID"];
        $yf_PROJECT["NAME"] = $row["NAME"];
		$yf_PROJECT["DESCRIPTION"] = $row["DESCRIPTION"];
		$yf_PROJECT["IDCONTACT"] = $row["IDCONTACT"];
		$yf_PROJECT["KTYPE"] = $row["KTYPE"];

        // push single yf_KPROJECT into final response array
        array_push($response["yf_PROJECT"], $yf_PROJECT);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no yf_PROJECTs found
    $response["success"] = 0;
    $response["message"] = "No yf_PROJECTs found";

    // echo no users JSON
    echo json_encode($response);
}
?>
