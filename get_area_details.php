<?php

/*
 * Following code will get single yf_AREA details
 * A yf_AREA is identified by yf_AREA id (pid)
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

    // get a yf_AREA from yf_AREAs table
    $result = mysql_query("SELECT *FROM yf_AREA WHERE ID = $pid");

    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {

            $result = mysql_fetch_array($result);

            $response["yf_AREA"] = array();
            $yf_AREA = array();
			$yf_AREA["ID"] = $result["ID"];
			$yf_AREA["NAME"] = $result["NAME"];
            // success
            $response["success"] = 1;

            // user node
            $response["yf_AREA"] = array();

            array_push($response["yf_AREA"], $yf_AREA);

            // echoing JSON response
            echo json_encode($response);
        } else {
            // no yf_AREA found
            $response["success"] = 0;
            $response["message"] = "No yf_AREA found";

            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no yf_AREA found
        $response["success"] = 0;
        $response["message"] = "No yf_AREA found";

        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>