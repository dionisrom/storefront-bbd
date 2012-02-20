<?
session_start();
$verif_cod = false;
if  ( isset($_REQUEST["img_cod"]) && $_SESSION["cod_unic"] == $_REQUEST["img_cod"] )
{
    $verif_cod = true  ;  
}
if ( isset($_REQUEST["salvez"]) && $_REQUEST["salvez"] == "da" && $verif_cod )
{
    include("../inc/global.php");
    $sql_mesaj = "INSERT INTO mesaje (nume,email,telefon,subiect,mesaj,ip,data) VALUES (";
    $sql_mesaj .= " '".$_REQUEST["nume"]."', ";
    $sql_mesaj .= " '".$_REQUEST["email"]."', ";
    $sql_mesaj .= " '".$_REQUEST["telefon"]."', ";
    $sql_mesaj .= " '".$_REQUEST["subiect"]."', ";
    $sql_mesaj .= " '".$_REQUEST["mesaj"]."', ";
    $sql_mesaj .= " '".$_SERVER["REMOTE_ADDR"]."', ";
    $sql_mesaj .= " '".date("d.m.Y H:i:s",time())."' ";
    $sql_mesaj .= ") ";
    mysql_query($sql_mesaj) or die ("Eroare salvare mesaj!");
    $headers = 'From: webmaster@pretuimsanatatea.ro' . "\r\n" .
    'Reply-To: webmaster@pretuimsanatatea.ro' . "\r\n" .
    'X-Mailer: PHP/' . phpversion().
    'MIME-Version: 1.0' . "\r\n".
    'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    mail("webmaster@pretuimsanatatea.ro","Mesaj din pagina de contact ".date("d.m.Y H:i:s",time()),"De la: ".$_REQUEST["nume"]."<br>Email: ".$_REQUEST["email"]."<br>Telefon: ".$_REQUEST["telefon"]."<hr>Mesaj:<br>".$_REQUEST["mesaj"],$headers);
       	
    echo '
    <html>
    <head>
        <title>Contact</title>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="description" content="Ortoprotetica - Contact">
        <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
        <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">    
    </head>
    <body>
        <div class="titlu_mic">Mesajul a fost trimis cu succes !</div>
    </body>
    </html>
    ';
    if ( file_exists("../images/temp/rnd".session_id().".jpg") )
    {
        unlink("../images/temp/rnd".session_id().".jpg") ;
    }
    unset($_SESSION["cod_unic"]);
}
else
{
    include ("../inc/random.php");
    $cod = get_rand_id(6);
    $_SESSION["cod_unic"] = $cod;
?>
<html>
	<head>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
		<title>Pagina de contact</title>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="description" content="Ortoprotetica - Pagina de contact">
        <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
        <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
        <script language="JavaScript" src="../js/formValidator.js"></script>
        <script language="JavaScript">

        // check form values
        function checkForm()
        {
            var nume = "";
            for (i=0;i<document.forms[0].elements.length;i++)
            {
                nume = "err_"+document.forms[0].elements[i].id;
                //alert(nume+"-"+typeof(document.getElementById(nume)) );
                if ( nume != "err_salvez" && nume != "err_creaza_cont" )
                {
                    if ( typeof(document.getElementById(nume)) != "undefined" )
                    {
                        document.getElementById(nume).innerHTML = "";
                    }
                }
            }
            // instantiate object
            fv = new formValidator();

            // perform checks
            // check for empty nume field
            if (fv.isEmpty(document.forms[0].elements[0].value))
            {
                fv.raiseError("Va rog introduceti numele!");
                document.getElementById("err_"+document.forms[0].elements[0].id).innerHTML="Va rog introduceti numele!";
            }

            // check for empty email address
            if (fv.isEmpty(document.forms[0].elements[1].value))
            {
                fv.raiseError("Va rog introduceti adresa de email !");
                document.getElementById("err_"+document.forms[0].elements[1].id).innerHTML="Va rog introduceti adresa de email !";
            }
            
            // check for valid email address format
            if (!fv.isEmpty(document.forms[0].elements[1].value) && !fv.isEmailAddress(document.forms[0].elements[1].value))
            {
                fv.raiseError("Adresa de email nu este valida !");
                document.getElementById("err_"+document.forms[0].elements[1].id).innerHTML="Adresa de email nu este valida !";
            }
            
            // check for empty telefon field
            if (fv.isEmpty(document.forms[0].elements[2].value))
            {
                fv.raiseError("Va rog introduceti numarul dumneavoastra de telefon !");
                document.getElementById("err_"+document.forms[0].elements[2].id).innerHTML="Va rog introduceti numarul dumneavoastra de telefon !";
            }
            
            // check for valid telefon field
            if ( !fv.isEmpty(document.forms[0].elements[2].value) && document.forms[0].elements[2].value.length != 10 )
            {
                fv.raiseError("Va rog introduceti un numar de telefon valid! (lungime diferita de 10 cifre)");
                document.getElementById("err_"+document.forms[0].elements[2].id).innerHTML="Va rog introduceti un numar de telefon valid ! (lungime diferita de 10 cifre)";
            }
            
            // check for empty Subiect field
            if (fv.isEmpty(document.forms[0].elements[3].value))
            {
                fv.raiseError("Va rog introduceti subiectul !");
                document.getElementById("err_"+document.forms[0].elements[3].id).innerHTML="Va rog introduceti subiectul!";
            }
            
            // check for empty mesaj field
            if (fv.isEmpty(document.forms[0].elements[4].value))
            {
                fv.raiseError("Va rog introduceti mesajul !");
                document.getElementById("err_"+document.forms[0].elements[4].id).innerHTML="Va rog introduceti mesajul!";
            }
            // all done

            // if errors, display, else proceed
            if (fv.numErrors() > 0)
            {
                //fv.displayErrors();
                return false;
            }
            else
            {
                return true;
            }
            
        }
        function checkIt(evt) {
            evt = (evt) ? evt : window.event  ;
            var charCode = (evt.which) ? evt.which : evt.keyCode ;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                //alert ("Acest camp accepta doar cifre !" );
                return false;
            }
            return true ;
        }
        </script>
	</head>
	<body style="background:transparent;">
	<div class="titlu_pag">Contact</div>
	<div class="titlu">SC Ortoprotetica</div>
	<form target="_self" method="post" id="form_mes" name="form_mes">
			<table cellpadding="2" cellspacing="0" border="0" style="white-space:nowrap;">
				<tr>
					<td style="border-top: 1px solid #367766; border-bottom: 1px solid #367766; padding-bottom:7px; padding-right: 10px;" valign="top">
						<div class="titlu_mic"><u>Localizare</u></div>
						<table cellpadding="2" cellspacing="0" border="0">
							<tr>
								<td>Adresa:</td><td class="adr">B-dul Dorobantilor; nr 9; bl A 9; ap 3</td>
							</tr>
							<tr>
								<td>Judet:</td><td class="adr">Braila</td>
							</tr>
							<tr>
								<td>Localitate:</td><td class="adr">Braila</td>
							</tr>
							<tr>
								<td>Cod postal:</td><td class="adr">810232</td>
							</tr>
						</table>
					</td>
					<td style="padding-left: 10px; border-top: 1px solid #367766; border-bottom: 1px solid #367766; padding-bottom:7px;" valign="top">
						<div class="titlu_mic"><u>Detalii fiscale</u></div>
						<table cellpadding="2" cellspacing="0" border="0">
							<tr>
								<td>Nr. in Reg. Com.:</td><td  class="adr">J09/441/27.05.2004</td>
							</tr>
							<tr>
								<td>Cod Fiscal:</td><td class="adr">RO16463753</td>
							</tr>
							<tr>
								<td>Cod IBAN:</td><td class="adr">RO14RZBR0000060011572532</td>
							</tr>
							<tr>
								<td>Banca:</td><td class="adr">RAIFFEISEN BANK AG APOLLO - Braila</td>
							</tr>
						</table>
					</td>	
				</tr>
				<tr>
					<td align="center" colspan="2" style="padding-left: 10px; border-bottom: 1px solid #367766; padding-bottom:7px;" valign="top">
						<div class="titlu_mic"><u>Date de contact</u></div>
						<table cellpadding="2" cellspacing="0" border="0" style="white-space:nowrap;">
							<tr>
								<td>Compartiment Medical:</td><td class="adr">0724 220270</td>
							</tr>
							<tr>
								<td>Mobil Vanzari/Comenzi:</td><td class="adr">0728 939568, 0728 939569</td>
							</tr>	
						</table>
					</td>
				</tr>
				<tr>
					<td style="padding-top:7px;">
                    Introduceti numele dumneavoastra *:</td>
            		<td style="padding-top:7px;"><input type="text" name="nume" id="nume" onkeyup="this.style.textTransform = 'uppercase';" value="<?=$_REQUEST['nume']?>" size="30" class="input" /><font id='err_nume' class="eroare_text"></font></td>
				</tr>
				<tr>
					<td>Adresa email *:</td>
            		<td><input type="text" name="email" id="email" onkeyup="this.style.textTransform = 'lowercase';" value="<?=$_REQUEST['email']?>" size="30" class="input" /><font id='err_email' class="eroare_text"></font></td>
				</tr>
				<tr>
					<td>Numar de telefon *:</td>
            		<td><input type="text" name="telefon" onKeyPress="return checkIt(event)" id="telefon" maxlength="10" onkeyup="this.style.textTransform = 'lowercase';" value="<?=$_REQUEST['telefon']?>" size="30" class="input" /><font id='err_telefon' class="eroare_text"></font></td>
				</tr>
				<tr>
					<td>Subiectul mesajului *:</td>
            		<td><input type="text" name="subiect" id="subiect" value="<?=$_REQUEST['subiect']?>" size="30" class="input" /><font id='err_subiect' class="eroare_text"></font></td>
				</tr>
				<tr>
					<td>Introduceti mesajul *:</td>
            		<td><textarea cols="28" rows="5" name="mesaj" id="mesaj" class="input" /><?=$_REQUEST['mesaj']?></textarea><font id='err_mesaj' class="eroare_text"></font></td>
				</tr>
                <tr>
                    <td>Introduceti textul din imagine:
                    <?
                        $dir = "../images/temp/";
                        if($dh = @opendir($dir))
                        {
                            while (false !== ($obj = readdir($dh))) {
                                if($obj=='.' || $obj=='..') continue;
                                if (!@unlink($dir.'/'.$obj)) SureRemoveDir($dir.'/'.$obj, true);
                            }
                        }
                        //header('Content-type: image/jpeg');
                        $im = @imagecreatetruecolor(60, 20)
                              or die('Cannot Initialize new GD image stream');
                        $text_color = imagecolorallocate($im, 255, 255, 255);
                        imagestring($im, 4, 5, 3,  $cod, $text_color);
                        $nume_img = "../images/temp/rnd".session_id().".jpg";
                        imagejpeg($im,$nume_img);
                        imagedestroy($im);
                    ?>
                    <img src="<?=$nume_img?>">
                    </td>
                    <td><input type="text" class="input" size=10 id="img_cod" name="img_cod"><font id='err_img_cod' class="eroare_text"></font></td>
                </tr>
				<tr>
			        <td colspan="2" align="center">
			            <input type="hidden" id="salvez" name="salvez" value="da">
			            <input type="button" onclick="if ( checkForm() ) { document.getElementById('form_mes').submit(); }" name="creaza_cont" id="creaza_cont" value="Transmite mesaj" class="submit" />
			        </td>
				</tr>
			</table>
		</form>
	</body>
</html>
<?
}
?>