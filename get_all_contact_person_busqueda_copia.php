<?php

/*
 * Following code will list all the yf_KCONTACTPERSONs
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();
$query = "SELECT  A.COUNTRY AS COUNTRY , A.NAME AS NAMECENTER ,
 B.NAME AS TYPE ,D.NAME AS AREA, F.KTYPENAME AS KTYPE, C.EMAIL AS EMAIL,
 C.ID AS IDPERSON 
 FROM yf_INSTITUTION A 
 INNER JOIN  yf_TYPE B ON  A.TYPE=B.ID 
 INNER JOIN yf_CONTACTPERSON C ON C.IDINST =  A.ID  
 INNER JOIN yf_AREA D ON C.AREA =  D.ID   
 INNER JOIN yf_PROJECT E ON E.IDCONTACT=C.ID  
 INNER JOIN yf_KTYPE F ON E.KTYPE=F.ID ";
 //" WHERE ".$country." 
// AND B.ID ". $type  ." 
// AND F.ID ".$ktype ." 
// AND D.ID ".$area. " 
// ORDER BY A.COUNTRY";
// get all yf_CONTACTPERSONs from yf_KCONTACTPERSONs table
$result = mysql_query($query) or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // yf_CONTACTPERSONs node
    $response["yf_RESULTADO"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $yf_RESULTADO = array();
        $yf_RESULTADO["COUNTRY"] = $row["COUNTRY"];
		$yf_RESULTADO["NAMECENTER"] = $row["NAMECENTER"];
        $yf_RESULTADO["TYPE"] = $row["TYPE"];
		$yf_RESULTADO["AREA"] = $row["AREA"];
		$yf_RESULTADO["KTYPE"] = $row["KTYPE"];
		$yf_RESULTADO["IDPERSON"] = $row["IDPERSON"];
		$yf_RESULTADO["EMAIL"] = $row["EMAIL"];

        // push single yf_KCONTACTPERSON into final response array
        array_push($response["yf_RESULTADO"], $yf_RESULTADO);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no yf_CONTACTPERSONs found
    $response["success"] = 0;
    $response["message"] = "No yf_CONTACTPERSONs found";

    // echo no users JSON
    echo json_encode($response);
}
?>
