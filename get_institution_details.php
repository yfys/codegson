<?php

/*
 * Following code will get single yf_INSTITUTION details
 * A yf_INSTITUTION is identified by yf_INSTITUTION id (pid)
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

    // get a yf_INSTITUTION from yf_INSTITUTIONs table
    $result = mysql_query("SELECT *FROM yf_INSTITUTION WHERE ID = '$pid'");

    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {

            $result = mysql_fetch_array($result);

            $response["yf_INSTITUTION"] = array();
            $yf_INSTITUTION = array();
			$yf_INSTITUTION["ID"] = $result["ID"];
			$yf_INSTITUTION["EMAIL"] = $result["EMAIL"];
			$yf_INSTITUTION["NAME"] = $result["NAME"];
			$yf_INSTITUTION["STREET"] = $result["STREET"];
			$yf_INSTITUTION["CITY"] = $result["CITY"];
			$yf_INSTITUTION["COUNTRY"] = $result["COUNTRY"];
			$yf_INSTITUTION["TYPE"] = $result["TYPE"];
			
            // success
            $response["success"] = 1;

            // user node
            $response["yf_INSTITUTION"] = array();

            array_push($response["yf_INSTITUTION"], $yf_INSTITUTION);

            // echoing JSON response
            echo json_encode($response);
        } else {
            // no yf_INSTITUTION found
            $response["success"] = 0;
            $response["message"] = "No yf_INSTITUTION found";

            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no yf_INSTITUTION found
        $response["success"] = 0;
        $response["message"] = "No yf_INSTITUTION found";

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