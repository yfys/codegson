
<?php
//ini_set( 'display_errors', 1 );
//error_reporting( E_ALL );
session_start();


$k = array_keys($_GET);
if (isset($_GET['lang'])) { $_SESSION['lang'] = $_GET['lang']; }
if (!isset($_SESSION['lang'])) { $_SESSION['lang'] = 'en'; }

if     ($_SESSION['lang'] == 'en') { include_once("lang_en.php"); }
elseif ($_SESSION['lang'] == 'es') { include_once("lang_es.php"); }
elseif ($_SESSION['lang'] == 'pt') { include_once("lang_pt.php"); }
elseif ($_SESSION['lang'] == 'it') { include_once("lang_it.php"); }
 

include('./databases/databasename.php');
 
 if (isset($_SESSION['userlogin']))
 {
    $accionlogout= "./logout.php";
    echo $l_bienvenida."  ";
    echo $_SESSION['userlogin'] ; 
  echo "   <A target='_blank' style='color: #22aadd;text-decoration: none;background-color: transparent;font-size: 1.0625rem;box-sizing: inherit;' HREF=$accionlogout >Logout</A><BR>";


            echo $mensaje3;
            // crea las variables y les asigna el valor
    
 $numero = count($_POST);
$tags = array_keys($_POST); // obtiene los nombres de las varibles
$valores = array_values($_POST);// obtiene los valores de las varibles
            for($i=0;$i<$numero;$i++){ 
                $$tags[$i]=$valores[$i]; 
                
               //echo "<p> <b>".$tags[$i]." </b>=".$valores[$i]."</p>";
            }
          
             

     
     //////NUEVO/////
        $country=$_GET['country'];
        $area=$_GET['area'];
        $ktype=$_GET['ktype'];
        $type=$_GET['type'];
     
 
     
 
            //echo $mensaje4;
 if (isset($_GET['country'])) {
      $country=$_GET['country'];
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

  
 
 if (isset($_GET['area'])) {
      $area=$_GET['area'];

            if (strcmp($area, "ALL")==0){
                $areab="%";
                $areab= " D.NAME LIKE  '".$areab."'";
            }
            else {
                $areab="%". $area ."%";

                $areab= " D.ID LIKE  '".$areab."'";
                

            }
            	

 }
     
     
  if (isset($_GET['ktype'])) {
	 $ktype= $_GET['ktype'];
	 

            if (strcmp($ktype, "ALL")==0){
            	$ktypeb="%";
                $ktypeb= " KTYPENAME LIKE '".$ktypeb."'";            
               
            }
            else 
            {
                $ktypeb="%". $ktype ."%";

                $ktypeb= " F.ID LIKE  '".$ktypeb."'";
                 
            }
 }



 if (isset($_GET['type'])) {
	 $type = $_GET['type'];


            if (strcmp($type, "ALL")==0){
                {
                $typeb="%";
                $typeb= " B.NAME LIKE '".$typeb."'";           
                }

            }
            else 
            {
                $typeb="%". $type ."%";

                $typeb= " B.ID LIKE  '".$typeb."'";
            }
 }



 
   
            /* Conexion a la base de datos para conseguir el typo*/
            require_once('./databases/databasename.php');

            $link = mysqli_connect(SERVERMYSQL, USER, PASS, DATABASE);

            /* check connection */
            if (mysqli_connect_errno()) {
                printf("%s: %s\n", $menerror1, $mysqli->connect_error);
                exit();
            }
 
            //TABLE COUNTRY 
            echo  "<table style='border: 1px solid black;
    border-collapse: collapse;width:100%' border='1'>";
            echo   "<tr>";
            echo "<th>$l_countryf</th>";
            echo "<th>$l_namec <br> $l_nameperson </th>";
            echo "<th>$l_typef2</th>";
            echo "<th>$l_areaf</th>";
            echo "<th>$l_ktype</th>";
            echo "<th>$l_contact</th>";
            echo " </tr>";
  
             $query = "SELECT  A.COUNTRY AS COUNTRY , A.NAME AS NAMECENTER , B.NAME AS TYPE ,D.NAME AS AREA, F.KTYPENAME AS KTYPE, C.ID AS IDPERSON, C.NAME AS NAME FROM yf_INSTITUTION A INNER JOIN  yf_TYPE B ON  A.TYPE=B.ID INNER JOIN yf_CONTACTPERSON C ON C.IDINST =  A.ID  INNER JOIN yf_AREA D ON C.AREA =  D.ID   INNER JOIN yf_PROJECT E ON E.IDCONTACT=C.ID  INNER JOIN yf_KTYPE F ON E.KTYPE=F.ID "." WHERE ".$countryb." AND  ". $typeb  ." AND  ".$ktypeb ." AND ".$areab. " ORDER BY A.COUNTRY";

           // echo "QUERY: " .$query;
         //    echo "<br>";
 
                $resultadoconsulta = mysqli_query($link, $query);
                $totalregistros = mysqli_num_rows($resultadoconsulta);
                $registrosporpagina = 10;// numero de registros que queremos en cada página
                $totalpaginas = ceil($totalregistros/$registrosporpagina); // Número exacto de páginas totales redondeado hacia bajo
     
                if(!isset($_GET['pagina'])){
                   $pagina=1;
                   $limit_inicio=($pagina*10)-10;//multiplicamos la página en la que estamos 
            //por el número de resultados y le restamos el número de resultados
                }else{
                    $pagina=$_GET['pagina'];
                    $limit_inicio=($pagina*10)-10;//indicamos a partir de qué resultado empieza la página
                    }
        $consultapagina= $query. " LIMIT ".$limit_inicio." , ".$registrosporpagina;
            
            
            
     
     
             
            if ($result = mysqli_query($link, $consultapagina)) {

                /* fetch associative array */
               

               
                while ($row = mysqli_fetch_row($result)) {
             
                    printf ("<tr> <td>%s</td> <td>%s <BR> %s</td> <td>%s</td> <td>%s</td><td>%s</td>"   , $row[0], $row[1],$row[6],$row[2], $row[3], $row[4] );
                    
                    echo "<td>";
                    $accionservidor=ADDRES_SERVER."/yourfuture/writemail.php";
                    echo "<form action='$accionservidor' method='POST'>";
                    echo "<input  type='hidden' name='idpersona' value=". $row[5]." >";
                    
                    echo "<input  type='hidden' name='country' value=". $country." >";
                    echo "<input  type='hidden' name='type' value=". $type." >";
                    echo "<input  type='hidden' name='ktype' value=". $ktype." >";
                    echo "<input  type='hidden' name='area' value=". $area." >";
                    echo "<input  type='hidden' name='pais' value=". $row[0]." >";
                    echo "<input  type='hidden' name='centro' value=". $row[1]." >";
                    echo "<input  type='hidden' name='contacto' value=". $row[6]." >";
                    echo "<input  type='hidden' name='tipocentro' value=". $row[2]." >";
                     echo "<input  type='hidden' name='areac' value=". $row[3]." >";
                     echo "<input  type='hidden' name='tipoproyecto' value=". $row[4]." >";
                    echo  "<input type='image' name='submit' src='./images/semail.png' border='0' alt='$l_buttomsubmit' />";
                     
                    echo "</td>";

                    echo "</form>";
                    echo "</tr>";
                }
              echo "</table>";
             echo "<br>";    
             echo "<br>";   
               
                $enlaceserver=ADDRES_SERVER .$_SERVER['PHP_SELF'];
                 
                
                $enlace=$enlaceserver."?country=".$country."&area=".$area."&type=".$type."&ktype=".$ktype."&pagina="; 
                
            
                
                
                
                 
                  for($i=1;$i<=$totalpaginas;$i++){ 
                      
                       $mipagina=$enlace.$i;
                      
                      if ($i==$pagina){
                           echo "<a style=' background-color: #22aadd;color: white;padding: 8px 16px;text-decoration:none' href='$mipagina'>";
                      echo $i; 
                      echo "</a>  ";
                    
                          
                      }
                      else
                      {
                     
                
                      echo "<a style='background-color: #0000FF; color: grey ;padding: 8px 16px;text-decoration: none;' href='$mipagina'>";
                      echo $i; 
                      echo "</a>  ";
                     
                      }
                      
                  } 
                    //echo "<li><a href='#'>&raquo;</a></li>";
               
     
                /* free result set */
                mysqli_free_result($result);
            }
             
            /* close connection */
            mysqli_close($link);

           
        } 
    else
        echo $l_registerm;

?>