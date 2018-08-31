<?php

/*
 * Following code will get single yf_PROJECT details
 * A yf_PROJECT is identified by yf_PROJECT id (pid)
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

    // get a yf_PROJECT from yf_PROJECTs table
    $result = mysql_query("SELECT *FROM yf_PROJECT WHERE ID = $pid");

    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {

            $result = mysql_fetch_array($result);

            $response["yf_PROJECT"] = array();
            $yf_PROJECT = array();
			$yf_PROJECT["ID"] = $result["ID"];
			$yf_PROJECT["NAME"] = $result["NAME"];
			$yf_PROJECT["DESCRIPTION"] = $result["DESCRIPTION"];
			$yf_PROJECT["IDCONTACT"] = $result["IDCONTACT"];
			$yf_PROJECT["KTYPE"] = $result["KTYPE"];
            // success
            $response["success"] = 1;

            // user node
            $response["yf_PROJECT"] = array();

            array_push($response["yf_PROJECT"], $yf_PROJECT);

            // echoing JSON response
            echo json_encode($response);
        } else {
            // no yf_PROJECT found
            $response["success"] = 0;
            $response["message"] = "No yf_PROJECT found";

            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no yf_PROJECT found
        $response["success"] = 0;
        $response["message"] = "No yf_PROJECT found";

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