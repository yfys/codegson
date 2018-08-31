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
if (isset($_GET["email"]) && isset($_GET["password"])) {
    $email = $_GET['email'];
	$password = $_GET['password'];

    $result = mysql_query("SELECT * FROM yf_CONTACTPERSON WHERE EMAIL LIKE '$email'");
	
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {

            $result = mysql_fetch_array($result);

            $response["yf_CONTACTPERSON"] = array();
            $yf_CONTACTPERSON = array();
			$yf_CONTACTPERSON["ID"] = $result["ID"];
			$yf_CONTACTPERSON["EMAIL"] = $result["EMAIL"];
			$yf_CONTACTPERSON["NAME"] = $result["NAME"];
			$yf_CONTACTPERSON["LASTNAME"] = $result["LASTNAME"];
			$yf_CONTACTPERSON["CONFIRMEMAIL"] = $result["CONFIRMEMAIL"];
			$yf_CONTACTPERSON["CONFIRMEMAILINST"] = $result["CONFIRMEMAILINST"];
			$yf_CONTACTPERSON["AREA"] = $result["AREA"];
			$yf_CONTACTPERSON["PASSWORD"] = $result["PASSWORD"];
			$yf_CONTACTPERSON["IDINST"] = $result["IDINST"];
			
            // Falta la validacion de confirmar email y confirmaremailinst
            
			if(password_verify($password, $yf_CONTACTPERSON["PASSWORD"])){
			
			// success
            $response["success"] = 1;

            // user node
            $response["yf_CONTACTPERSON"] = array();

            array_push($response["yf_CONTACTPERSON"], $yf_CONTACTPERSON);
			
			}else{
				
				// no yf_CONTACTPERSON found
            $response["success"] = 0;
            $response["message"] = "Contraseña incorrecta '$password'";
				
			}
			
            

            // echoing JSON response
            echo json_encode($response);
        } else {
            // no yf_CONTACTPERSON found
            $response["success"] = 0;
            $response["message"] = "No yf_CONTACTPERSON found '$password'";

            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no yf_CONTACTPERSON found
        $response["success"] = 0;
        $response["message"] = "No yf_CONTACTPERSON found '$password'";

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