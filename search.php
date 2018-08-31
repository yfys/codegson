
<?php

session_start();


$k = array_keys($_GET);
if (isset($_GET['lang'])) { $_SESSION['lang'] = $_GET['lang']; }
if (!isset($_SESSION['lang'])) { $_SESSION['lang'] = 'en'; }

if     ($_SESSION['lang'] == 'en') { include_once("lang_en.php"); }
elseif ($_SESSION['lang'] == 'es') { include_once("lang_es.php"); }
elseif ($_SESSION['lang'] == 'pt') { include_once("lang_pt.php"); }
elseif ($_SESSION['lang'] == 'it') { include_once("lang_it.php"); }
 
require_once('./databases/databasename.php');

if (!isset($_SESSION['userlogin'])) {
   echo $mustbelogin;

} else {
    
    $accionlogout= "./logout.php";
    echo $l_bienvenida."  ";
    echo $_SESSION['userlogin'] ; 
  echo "   <A target='_blank' style='color: #22aadd;text-decoration: none;background-color: transparent;font-size: 1.0625rem;box-sizing: inherit;' HREF=$accionlogout >".Logout. "</A><BR>";

/// Formulario de busqueda   
 


        $accionservidor= ADDRES_SERVERFUTURE."/lookfor_page.php";
        
        echo "<form action='$accionservidor' method='GET'>";

        echo "<br>";
        echo $l_country; 

        /* Conexion a la base de datos para conseguir el typo*/
        

        $link = mysqli_connect(SERVERMYSQL, USER, PASS, DATABASE);

        /* check connection */
        if (mysqli_connect_errno()) {
            printf("%s: %s\n", $menerror1, $mysqli->connect_error);
            exit();
        }


        $query = "SELECT DISTINCTROW  COUNTRY FROM yf_INSTITUTION";

         
         echo "<select name='country'>";
         echo "<option value='ALL'>ALL</option>" ; 
        if ($result = mysqli_query($link, $query)) {

            /* fetch associative array */

           
            while ($row = mysqli_fetch_row($result)) {
                printf ("<option value=%s>%s</option>" , $row[0], $row[0]);
                
            }
         


            /* free result set */
            mysqli_free_result($result);
        }
          echo  "</select>";
        /* close connection */
        mysqli_close($link);

        echo "<br>";
        echo  $l_area; 

        /* Conexion a la base de datos para conseguir el typo*/
        require_once('./databases/databasename.php');

        $link = mysqli_connect(SERVERMYSQL, USER, PASS, DATABASE);

        /* check connection */
        if (mysqli_connect_errno()) {
            printf("%s: %s\n", $menerror1, $mysqli->connect_error);
            exit();
        }


        $query = "SELECT DISTINCTROW A.ID AS ID, A.NAME AS NAME FROM yf_AREA A, yf_CONTACTPERSON B WHERE B.AREA= A.ID";

         
         echo "<select name='area'>";
         echo "<option value='ALL'>ALL</option>" ; 
        if ($result = mysqli_query($link, $query)) {

            /* fetch associative array */

           
            while ($row = mysqli_fetch_row($result)) {
                printf ("<option value=%s>%s</option>" , $row[0], $row[1]);
                
            }
         


            /* free result set */
            mysqli_free_result($result);
        }
          echo  "</select>";
        /* close connection */
        mysqli_close($link);
        echo "<br>";
        echo  $l_type; 

        /* Conexion a la base de datos para conseguir el typo*/
        require_once('./databases/databasename.php');

        $link = mysqli_connect(SERVERMYSQL, USER, PASS, DATABASE);

        /* check connection */
        if (mysqli_connect_errno()) {
            printf("%s: %s\n", $menerror1, $mysqli->connect_error);
            exit();
        }


        $query = "SELECT DISTINCTROW A.ID AS ID, A.NAME AS TYPE FROM yf_TYPE A, yf_INSTITUTION B WHERE B.TYPE= A.ID";

         
         echo "<select name='type'>";
         echo "<option value='ALL'>ALL</option>" ; 
        if ($result = mysqli_query($link, $query)) {

            /* fetch associative array */

           
            while ($row = mysqli_fetch_row($result)) {
                printf ("<option value=%s>%s</option>" , $row[0], $row[1]);
                
            }
         


            /* free result set */
            mysqli_free_result($result);
        }
          echo  "</select>";
        /* close connection */
        mysqli_close($link);
        echo "<br>";
        echo $l_kypefilter;



        /* Conexion a la base de datos para conseguir el typo*/
        require_once('./databases/databasename.php');

        $link = mysqli_connect(SERVERMYSQL, USER, PASS, DATABASE);

        /* check connection */
        if (mysqli_connect_errno()) {
            printf("%s: %s\n", $menerror1, $mysqli->connect_error);
            exit();
        }


        $query = "SELECT DISTINCTROW A.ID AS ID, A.KTYPENAME AS KTYPE FROM yf_KTYPE A, yf_PROJECT B WHERE B.KTYPE= A.ID ";

         
         echo "<select name='ktype'>";
         echo "<option value='ALL'>ALL</option>" ; 
        if ($result = mysqli_query($link, $query)) {

            /* fetch associative array */

           
            while ($row = mysqli_fetch_row($result)) {
                printf ("<option value=%s>%s</option>" , $row[0], $row[1]);
                
            }
         


            /* free result set */
            mysqli_free_result($result);
        }
          echo  "</select>";
        /* close connection */
        mysqli_close($link);
        echo "<br>"; 
        echo  "<input type='image' name='submit' src='./images/lupa.jpg' border='0' alt='$l_buttomsubmit' />";
         
        echo "</form>";

/// FIN Formulario de busqueda   

}
 


 

?>