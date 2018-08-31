<?php

	///// Etiquetas del formaulario
    $l_datacenter="Datos del Centro de Trabajo";
    $l_namecenter = "Nombre del centro:";
    $l_street = "Calle:";
    $l_city="Ciudad:";
    $l_country="Pais:";
    $l_emailcenter="email:";
    $l_type="Tipo de Centro:";
    $l_datapersonal="Datos personales  y área de conocimiento";
    $l_namepersonal="Nombre:";
    $l_lastname="Apellidos:";
    $l_email="email:";
    $l_password="Password:";
    $l_passwordagain="Repita el password:";
    $l_area="Seleccione área:";
    $l_project="Datos del proyecto";
    $l_nameproject="Si tiene proyecto, escriba el nombre del proyecto:";
    $l_ktype="Seleccione tipo de proyecto KAXXX que busca o que usted tiene:";
    $l_desproject="Descripción corta:";
    $l_kypefilter="Seleccione tipo de proyecto:";

    $l_buttomsubmit="Aceptar";
    
    //Etiquetas del placeholder del formulario
    $l_namecenterf = "Nombre del centro de trabajo";
    $l_streetf = "Calle";
    $l_cityf="Ciudad";
    $l_countryf="Pais";
    $l_emailcenterf="email coorporativo";
    $l_typef="Seleccione el tipo de Centro";

    $l_namepersonalf="Nombre";
    $l_lastnamef="Apellidos";
    $l_emailf="email";
    $l_passwordf="Password";
    $l_passwordagainf="Repite el password";
    $l_areaf="Seleccione área";
    $l_nameprojectf="Nombre del proyecto";
    $l_desprojectf="Descripción corta";
 
// Cabeceras de la tabla
    $l_typef2="Tipo de Centro";
    $l_ktype="Tipo de proyecto";
    $l_areaf="Area";
    $l_contact="Contacta";
    $l_namec="Centro";
//Menasjes de aviso
    $mensaje1="Opcional";
    $mensaje2="Registro finalizado.";
    $mensaje3="Estas visualizando los datos según los siguientes criterios. \n";
    $mensaje4="Resultados: \n";

//MENSAJES DE ERROR
    $menerror1="Error conectando al servidor. Intentelo más tarde";
    $menerror2="Se ha producido un error en el captcha. Por favor revísalo";
    $menerror3="Se ha producido un error en el password";
    $menerror4="Debe aceptar las condiciones de la web";
    $menerror5="Se ha producido un error finalizando el registro. \n Por favor, intentelo de nuevo.";

 //Consejos   
     $l_adv1="Para mayor seguridad, deberias usar letras, numeros y caracteres especiales.";

//Mensajes email
     $mensaemail1="Completa el registro";
     $mensaemail2="Por favor pincha en el enlace de abajo. Si no te funciona copia el enlace en una nueva \n ventana de tu navagador";
      $mensaemailsend3="Tienes un mensaje, en el que se busca socio Europeo";
      $mensaemailsend4="Mensaje de email enviado.\n Deseamos que tengas suerte. \n Puedes seguir buscando.";


//Form  email2
     $emailinfo="Formulario de contacto";
     $mensaemail3="Escribe con detalle el texto del email. Tus datos personales no serán compartidos.";
     $mensaemail4="Si deseas compartir  tu email marca esta casilla";
     
    $l_buttomsubmit2="Enviar email";

     $l_textoemail="Escribe tu email aqui";


// Detalles del registro
     $info1="Su instución recibirá un email que debe confirmar.";

     $info2="Usted recibirá un email que debe confirmar.";

     $l_pic="PIC";

     $l_picenter="Introduzca el PIC de su centro";
     $l_registerm="Debe estar registrado para realizar una consulta.";

     $l_login="Introduzca su nombre de usuario (email) y password ";
     $l_instiregsiter= "Su institución estaba registrada. Chequee su email para completar el registro.";
     $l_picnumber="Introduzca su PIC";
     $l_condition="Acepta las ";
     $condiciones="Condiciones";
     $l_mustcaptcha="Debe pulsar el captcha";
 	 $_robot="El captcha te detecta como un robot";
     $l_capchadied="El captcha te ha caducado. Recarga la pagina de nuevo";
     $l_instiregister="Institución registrada previamente.";
     $l_peopleregister="Usted ya se registró previamente.";
     $l_lemailregister="Email registrado:";
     $l_lemailregisterf="Email registrado";
     $l_combination="La combinacion password/email no coincide";
     $mustbelogin="Debe estar logeado para buscar";
     $registerendpe="Registro finalizado.";
     $registerendin="Institución registrada correctamente.";

//Recuperar Contraseña
     $l_recuperarcontrasena="¿Has olvidado tu contraseña?";
     $l_recuperacion ="Recuperar contraseña";
     $l_titulo = "Correo de recuperación";
     $l_mensaje ="Haga click en este enlace para recuperar su contraseña";
     $l_emailnoencontrado = "No hemos encontrado el email en nuestro sistema o no esta confirmado su registro";
     $l_contrasena = "Recuperar contraseña";
     $l_confirmarcontrasena = "Confirmar Contraseña";
     $l_datosget = "Faltan los datos obtenidos por la barra de direccion";
     $l_contrasenaactualizada= "Su contraseña se ha actualizado correctamente";

//LOGIN PAGE
    $l_checkemail="Por favor comprueba tu email. En algunos casos debes comprobar la bandeja de spam";
    $l_mustconfirmemail="Usted debe confirmar el email antes de realizar el login";
    $l_mustconfirmemailint="Su institución debe confirmar el email";
    $l_passwdwrong="El password introducido no es correcto";
    $l_menerror1="Error al actualizar el password";
    $l_confirm1="Debe confirmar el email que ha recibido antes de hacer login";
    $l_confirm2="Si intitución debe confirmar el email que ha recibido antes de hacer login";
    $l_bienvenida="Bienvenido";
    $l_busquedasocios="Usa el menu para buscar socios";
    $l_buttomsubmitsearch="Buscar con los mismos criterios de nuevo";

//MENSAJES REGISTER PAGE
    $l_mensajename="Debe introducir al menos 3 caracteres. Contiene carácter no válido";
    $l_mensajepic="PIC con 10 numeros. Rellena con 0 por la izquierda.";
$mensajeeliminar="Pulse   para eliminar su cuenta";

//MENSAJES DE CORREO ELECTRONICO
$l_saludo="Hola ";
$l_mensaemail1=" Confirmar email para darte de alta";
$l_mensaemail2="Has recibido este correo porque has iniciado<br> el proceso de alta en";
$l_mensaemail3="Para seguir con el proceso tienes que pulsar";
$l_mensaemail4="Continuar";
$l_mensaemail5=" Atentamente, ";
$l_mensaemail6=" El equipo Your Future Your Smartphone";


$l_mensaemailrestablece=" Restablecer contraseña en yfys";
$l_mensaemailrestablece2="Has recibido este correo porque has iniciado<br> el proceso de restablecimiento de contraseña en";
$l_mensaemailrestablece3="Para seguir con el proceso tienes que pulsar";
$l_pie1="Este mensaje y, en su caso, los ficheros anexos son confidenciales, especialmente en lo que respecta a los datos personales, y se dirigen exclusivamente al destinatario referenciado. Si usted no lo es y lo ha recibido por error o tiene conocimiento del mismo por cualquier motivo, le rogamos que lo comunique por este medio y proceda a destruirlo o borrarlo, y que en todo caso se abstenga de utilizar, reproducir, alterar, archivar o comunicar a terceros el presente mensaje y ficheros anexos, todo ello bajo pena de incurrir en responsabilidades legales. El emisor no garantiza la integridad, rapidez o seguridad del presente correo, ni se responsabiliza de posibles perjuicios derivados de la captura, incorporaciones de virus o cualesquiera otras manipulaciones efectuadas por terceros.";

$l_pie2="En conformidad con lo previsto en la Ley Orgánica 15/1999 de 13 de diciembre, sus datos podrán ser incorporados a un fichero automatizado con la finalidad de poder mantener el contacto entre las partes. Podrá ejercitar los derechos de acceso, rectificación, cancelación y oposición de sus datos enviando una comunicación por escrito a la atención del IES Cristobal de Monroy. Avd de la Constitucion s/n 41500 Alcalá de Guadaira (Sevilla-España)";


/// MENSAJES DE BAJA

$l_mensajebaja1="Baja del sistema.";
$l_mensajebaja2="El sistema no permite la modificación de los datos ya que se debe de realizar la comprobación con emails de su centro y el suyo";
$l_mensajebaja3="  Si desea modificar su password puede usar el sistema de recuperar el password.";
$l_mensajebaja4="Si pulsa el botón se va a proceder a eliminar sus datos del sistema. Se enviará un email que debe confirmar";

$l_mensajebaja5="¿Esta seguro de eliminar sus datos?";
 $l_mensajebaja6="Debe estar registrado";   

$l_titulobaja="Correo de baja";
$l_mensaemailbaja1=" Confirmar email para darte de baja";
$l_mensaemailbaja2="Has recibido este correo porque has iniciado<br> el proceso de baja en";
 
$l_confirmpassword="Por su seguridad introduzca su password";
$l_passfail="Password erroneo";
$l_mensajebajadelok="Sus datos ya no estan en el sistema";
 $l_nuevomensa="Solicite un nuevo mensaje de baja";

$l_mensaemailsend1=" Has recibido un mensaje de un socio";
$l_mensaemailsend2="Has recibido este correo porque alguien intenta contactar contigo en ";
$l_mensaemailsend3="El mensaje es el siguiente:";

$l_passwordinsti="Introduce por seguridad  el email  de la institucion a la que te perteneces.";
$l_salgasistema="Realice logout para registrarse.";
$l_mensajeborrarusuario="Borrar usuario";
$l_nameperson="Contacto";
$l_personadestino="Email con destino";
?>
