<?php

/*
 * Following code will list all the yf_KCONTACTPERSONs
 */

// array for JSON response


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db


 if (isset($_GET['COUNTRY'])) {
      $country=$_GET['COUNTRY'];
       if (strcmp($country, "ALL")==0){

            	$countryb="%";
                $countryb= " COUNTRY LIKE  '".$countryb."'";
            
           

            }
            else 
            {
            	$countryb="%". $country ."%";

                $countryb= " COUNTRY LIKE  '".$countryb."'";
            
 
            }
 }

    
 
 if (isset($_GET['AREA'])) {
      $area=$_GET['AREA'];

            if (strcmp($area, "ALL")==0){
                $areab="%";
                $areab= " D.NAME LIKE  '".$areab."'";
            }
            else {
                $areab="%". $area ."%";

                $areab= " D.NAME LIKE  '".$areab."'";
                

            }
            	

 }
 if (isset($_GET['KTYPE'])) {
	 $ktype= $_GET['KTYPE'];
	 

            if (strcmp($ktype, "ALL")==0){
            	$ktypeb="%";
                $ktypeb= " KTYPENAME LIKE '".$ktypeb."'";            
               
            }
            else 
            {
                $ktypeb="%". $ktype ."%";

                $ktypeb= " KTYPENAME LIKE  '".$ktypeb."'";
                 
            }
 }



 if (isset($_GET['TYPE'])) {
	 $type = $_GET['TYPE'];


            if (strcmp($type, "ALL")==0){
                {
                $typeb="%";
                $typeb= " B.NAME LIKE '".$typeb."'";           
                }

            }
            else 
            {
                $typeb="%". $type ."%";

                $typeb= " B.NAME LIKE  '".$typeb."'";
            }
 }






$db = new DB_CONNECT();




            $query = "SELECT  A.COUNTRY AS COUNTRY , A.NAME AS NAMECENTER , B.NAME AS TYPE ,D.NAME AS AREA, F.KTYPENAME AS KTYPE, C.ID AS IDPERSON FROM yf_INSTITUTION A INNER JOIN  yf_TYPE B ON  A.TYPE=B.ID INNER JOIN yf_CONTACTPERSON C ON C.IDINST =  A.ID  INNER JOIN yf_AREA D ON C.AREA =  D.ID   INNER JOIN yf_PROJECT E ON E.IDCONTACT=C.ID  INNER JOIN yf_KTYPE F ON E.KTYPE=F.ID "." WHERE ".$countryb." AND  ". $typeb  ." AND  ".$ktypeb ." AND ".$areab. " ORDER BY A.COUNTRY";

 
$response = array();

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
    $response["message"] = "No hay resultados";

    // echo no users JSON
    echo json_encode($response);
}
?>
