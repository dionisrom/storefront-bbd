<?
session_start();
date_default_timezone_set('Europe/Bucharest');
if ( isset($_REQUEST["salvez"]) )
{
    include ("inc/global.php");
    include ("inc/random.php");
    $q_user = mysql_query("SELECT id FROM useri WHERE usr like '".$_REQUEST["username"]."'");
    if ( mysql_numrows($q_user) == 0)
    {
        $cod = get_rand_id(10);
	    //echo "Primire date - in lucru !";
        $str = "INSERT INTO useri (nume, prenume, id_judet,localitate,adresa,telefon,email,data_inscriere,usr,par,cod_postal,telefon_mobil,fax,cod_validare) VALUES (";
        $str .= " '".$_REQUEST["nume"]."', ";
        $str .= " '".$_REQUEST["prenume"]."', ";
        $str .= " ".$_REQUEST["judet"].", ";
        $str .= " '".$_REQUEST["localitate"]."', ";
        $str .= " '".$_REQUEST["adresa"]."', ";
        $str .= " '".$_REQUEST["telefon"]."', ";
        $str .= " '".$_REQUEST["email"]."', ";
        $str .= " '".date("d.m.Y",time())."', ";
        $str .= " '".$_REQUEST["username"]."', ";
        $str .= " '".md5($_REQUEST["parola"])."', ";
        $str .= " '".$_REQUEST["cod_postal"]."', ";
        $str .= " '".$_REQUEST["telefon_mobil"]."', ";
        $str .= " '".$_REQUEST["fax"]."', ";
        $str .= " '".$cod."' ";
        $str .= ")";
        mysql_query($str) or die ("Sistemul a generat o eroare la introducerea contului in baza de date!<br>".$str."<br>".mysql_error());
        //echo $str;
        $mesaj = "Bine ati venit pe site-ul firmei Ortoprotetica .<br>Pentru a finaliza crearea contului dumneavoastra va rugam sa verificati emailul. Sistemul a trimis un email ce contine un link pentru a valida contul dumneavoastra. Va rugam sa verificati in INBOX sau in SPAM / JUNK . Folositi link-ul din continutul mail-ului pentru validarea contului.<br> Va multumim !";
        
        $headers = 'From: webmaster@ortoprotetica.ro' . "\n" .
        'Reply-To: webmaster@ortoprotetica.ro' . "\n" .
        'X-Mailer: PHP/' . phpversion().
        'MIME-Version: 1.0' . "\n".
        'Content-type: text/html; charset=utf-8' . "\n";
        $rezultmail = mail($_REQUEST["email"],"Validare cont utilizator nou site Ortoprotetica","Bine ati venit pe site-ul firmei SC Ortoprotetica .<br>Pentru a finaliza autentificarea folositi urmatorul link <a href='http://www.ortoprotetica.ro/dev/?validare=1&username=".$_REQUEST["username"]."&cod_validare=".$cod."'>VALIDARE (http://www.ortoprotetica.ro/?validare=1&username=".$_REQUEST["username"]."&cod_validare=".$cod.")</a>.<br> Va multumim !",$headers) ;
        if ( $rezultmail )
        {
            echo '
            <html>
            <head>
                <title>Creare cont nou utilizator</title>
                <meta http-equiv="Pragma" content="no-cache">
                <meta http-equiv="Cache-Control" content="no-cache">
                <meta name="description" content="Ortoprotetica - Creare cont utilizator nou">
                <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
                <LINK HREF="css/default.css" REL="stylesheet" TYPE="text/css"> 
				<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script> 
				<script type="text/javascript">
					$(document).ready(function(){
						$("#main_frame",window.parent.document).height($("html").height()+10);
					});    
				</script>
            </head>
            <body>
                <div class="titlu_mic">'.$mesaj.'</div>
            </body>
            </html>
            ';
        }
        else
        {
            echo '
            <html>
            <head>
                <title>Creare cont nou utilizator</title>
                <meta http-equiv="Pragma" content="no-cache">
                <meta http-equiv="Cache-Control" content="no-cache">
                <meta name="description" content="Ortoprotetica - Creare cont utilizator nou">
                <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
                <LINK HREF="css/default.css" REL="stylesheet" TYPE="text/css">
				<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script> 
				<script type="text/javascript">
					$(document).ready(function(){
						$("#main_frame",window.parent.document).height($("html").height()+10);
					});    
				</script>
            </head>
            <body>
                <div class="titlu_mic">Emailul nu a fost trimis catra utilizator!</div>
            </body>
            </html>
            ';
        }
    }
    else
    {
        echo '
        <html>
        <head>
            <title>Creare cont nou utilizator</title>
            <meta http-equiv="Pragma" content="no-cache">
            <meta http-equiv="Cache-Control" content="no-cache">
            <meta name="description" content="Ortoprotetica - Resetare parola utilizator">
            <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
            <LINK HREF="css/default.css" REL="stylesheet" TYPE="text/css">
			<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script> 
			<script type="text/javascript">
				$(document).ready(function(){
					$("#main_frame",window.parent.document).height($("html").height()+10);
				});    
			</script>
        </head>
        <body>
            <div class="titlu_mic">
                Username-ul '.$_REQUEST["username"].' deja exista in baza noastra de date. Va rugam sa modificati aceasta informatie. <a href="javascript: history.go(-1);">Inapoi la pagina de creare cont utilizator</a>
            </div>
        </body>
        </html>
        ';    
    }
}
else
{
?>
<html>
<head>
	<title>Creare utilizator nou</title>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="description" content="Ortoprotetica - Creare utilizator nou">
    <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
    <LINK HREF="css/default.css" REL="stylesheet" TYPE="text/css">
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script> 
	<script type="text/javascript">
		$(document).ready(function(){
			$("#main_frame",window.parent.document).height($("html").height()+10);
		});    
	</script>
    <script>
        function toggleContainer(id)
        {
            if (document.getElementById("sunt_societate").checked==true )
            {
                document.getElementById(id).style.display = "block";
                document.getElementById("sunt_societate").value = 1;
			}
            else
            {
                document.getElementById(id).style.display = "none";
                document.getElementById("sunt_societate").value = 0;
			}
        }
       
    </script>
    <script language="JavaScript" src="js/formValidator.js"></script>
	<script language="JavaScript">

	// check form values
	function checkForm()
	{
        var nume = "";
        for (i=0;i<document.forms[0].elements.length;i++)
        {
            nume = "err_"+document.forms[0].elements[i].id;
            //alert(nume+"-"+typeof(document.getElementById(nume)) );
            if ( nume != "err_link_coduri" && nume != "err_sunt_societate" && nume != "err_salvez" && nume != "err_creaza_cont" )
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
		// check for empty username field
		if (fv.isEmpty(document.forms[0].elements[0].value))
		{
			fv.raiseError("Va rog introduceti utilizatorul !");
            document.getElementById("err_"+document.forms[0].elements[0].id).innerHTML="Va rog introduceti utilizatorul !";
		}
        // check for empty parola field
        if (fv.isEmpty(document.forms[0].elements[1].value))
        {
            fv.raiseError("Va rog introduceti o parola!");
            document.getElementById("err_"+document.forms[0].elements[1].id).innerHTML="Va rog introduceti o parola!";
        }
        // check for parola este parola de verificare
        if ( document.forms[0].elements[2].value != document.forms[0].elements[1].value )
        {
            fv.raiseError("Parola este diferita de parola verificare! ");
            document.getElementById("err_"+document.forms[0].elements[2].id).innerHTML="Parola este diferita de parola verificare! ";
        }
        // check for empty nume field
        if (fv.isEmpty(document.forms[0].elements[3].value))
        {
            fv.raiseError("Va rog introduceti numele!");
            document.getElementById("err_"+document.forms[0].elements[3].id).innerHTML="Va rog introduceti numele!";
        }
        
        // check for empty prenume field
        if (fv.isEmpty(document.forms[0].elements[4].value))
        {
            fv.raiseError("Va rog introduceti prenumele!");
            document.getElementById("err_"+document.forms[0].elements[4].id).innerHTML="Va rog introduceti prenumele!";
        }
        
		// check for empty email address
		if (fv.isEmpty(document.forms[0].elements[5].value))
		{
			fv.raiseError("Va rog introduceti adresa de email !");
            document.getElementById("err_"+document.forms[0].elements[5].id).innerHTML="Va rog introduceti adresa de email !";
		}

		// check for valid email address format
		if (!fv.isEmpty(document.forms[0].elements[5].value) && !fv.isEmailAddress(document.forms[0].elements[5].value))
		{
			fv.raiseError("Adresa de email nu este valida !");
            document.getElementById("err_"+document.forms[0].elements[5].id).innerHTML="Adresa de email nu este valida !";
		}
        
        // check for empty email verificare address
        if (fv.isEmpty(document.forms[0].elements[6].value))
        {
            fv.raiseError("Va rog introduceti adresa de email de verificare !");
            document.getElementById("err_"+document.forms[0].elements[6].id).innerHTML="Va rog introduceti adresa de email de verificare !";
        }
        
        // check for valid email de verificare address format
        if (!fv.isEmpty(document.forms[0].elements[6].value) && !fv.isEmailAddress(document.forms[0].elements[6].value))
        {
            fv.raiseError("Adresa de email de verificare nu este valida !");
            document.getElementById("err_"+document.forms[0].elements[6].id).innerHTML="Adresa de email de verificare nu este valida !";
        }
        
        // check for email egal cu email verificare
        if ( document.forms[0].elements[6].value != document.forms[0].elements[5].value )
        {
            fv.raiseError("Adresa de email este diferita de adresa de email de verificare !");
            document.getElementById("err_"+document.forms[0].elements[6].id).innerHTML="Adresa de email este diferita de adresa de email de verificare !";
        }
        
        // check for empty adresa field
        if (fv.isEmpty(document.forms[0].elements[7].value))
        {
            fv.raiseError("Va rog introduceti adresa !");
            document.getElementById("err_"+document.forms[0].elements[7].id).innerHTML="Va rog introduceti adresa !";
        }
        
        // check for empty localitate field
        if (fv.isEmpty(document.forms[0].elements[9].value))
        {
            fv.raiseError("Va rog introduceti localitatea !");
            document.getElementById("err_"+document.forms[0].elements[9].id).innerHTML="Va rog introduceti localitatea !";
        }
        
        // check for empty judet field
        if ( document.forms[0].elements[10].selectedIndex==0 )
        {
            fv.raiseError("Va rog selectati judetul !");
            document.getElementById("err_"+document.forms[0].elements[10].id).innerHTML="Va rog selectati judetul !";
        }
        
        // check for empty telefon field
        if (fv.isEmpty(document.forms[0].elements[11].value))
        {
            fv.raiseError("Va rog introduceti numarul dumneavoastra de telefon !");
            document.getElementById("err_"+document.forms[0].elements[11].id).innerHTML="Va rog introduceti numarul dumneavoastra de telefon !";
        }
        
        // check for valid telefon field
        if ( !fv.isEmpty(document.forms[0].elements[11].value) && document.forms[0].elements[11].value.length != 10 )
        {
            fv.raiseError("Va rog introduceti un numar de telefon valid! (lungime diferita de 10 cifre)");
            document.getElementById("err_"+document.forms[0].elements[11].id).innerHTML="Va rog introduceti un numar de telefon valid ! (lungime diferita de 10 cifre)";
        }
        
        // check for valid telefon mobil field
        if ( !fv.isEmpty(document.forms[0].elements[12].value) && document.forms[0].elements[12].value.length != 10 )
        {
            fv.raiseError("Va rog introduceti un numar de telefon mobil valid! (lungime diferita de 10 cifre)");
            document.getElementById("err_"+document.forms[0].elements[12].id).innerHTML="Va rog introduceti un numar de telefon mobil valid ! (lungime diferita de 10 cifre)";
        }
        
        // check for valid fax field
        if ( !fv.isEmpty(document.forms[0].elements[13].value) && document.forms[0].elements[13].value.length != 10 )
        {
            fv.raiseError("Va rog introduceti un numar de fax valid! (lungime diferita de 10 cifre)");
            document.getElementById("err_"+document.forms[0].elements[13].id).innerHTML="Va rog introduceti un numar de fax valid ! (lungime diferita de 10 cifre)";
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
<body>
<div class="titlu_pag">Creare cont nou</div>
<form target="_self" method="post" id="form_cont" name="form_cont">
    <table cellpadding="2" cellspacing="0" style="white-space:nowrap;">                    
        <tr><td colspan="3" align="left" class="sectiune_formular"><strong>Detalii cont</strong></td></tr>
        <tr>
            <td width=130>Username <font style="color: #F00; vertical-align: super;">*</font>:</td>
            <td><input type="text" name="username" id="username" value="<? if ( isset($_REQUEST['username']) ) echo $_REQUEST['username'];?>" size="30" maxlength="32" class="input" /></td>
            <td id="err_username" class="eroare_text"></td>
        </tr>
        <tr>
            <td >Parola <font style="color: #F00; vertical-align: super;">*</font>:</td>
            <td><input type="password" name="parola" id="parola" value="" size="30" maxlength="30" class="input" /></td>
            <td id="err_parola" class="eroare_text"></td>
        </tr>
        <tr>
            <td >Verificare parola <font style="color: #F00; vertical-align: super;">*</font>:</td>
            <td><input type="password" name="parola_verificare" id="parola_verificare" value="" size="30" maxlength="30" class="input" /></td>
            <td id="err_parola_verificare" class="eroare_text"></td>
        </tr>
        <tr><td colspan="3" align="left" class="sectiune_formular"><strong>Detalii personale</strong></td></tr>
        <tr>
            <td >Nume <font style="color: #F00; vertical-align: super;">*</font>:</td>
            <td><input type="text" name="nume" id="nume" value="<? if ( isset($_REQUEST['nume']) ) echo $_REQUEST['nume'];?>" size="30" class="input" /></td>
            <td id="err_nume" class="eroare_text"></td>
        </tr>
        <tr>
            <td >Prenume <font style="color: #F00; vertical-align: super;">*</font>:</td>
            <td><input type="text" name="prenume" id="prenume" value="<? if ( isset($_REQUEST['prenume']) ) echo $_REQUEST['prenume'];?>" size="30" class="input" /></td>
            <td id="err_prenume" class="eroare_text"></td>
        </tr>
        <tr>
            <td >Email <font style="color: #F00; vertical-align: super;">*</font>:</td>
            <td><input type="text" name="email" id="email" size="30" value="<? if ( isset($_REQUEST['email']) ) echo $_REQUEST['email'];?>" class="input" /></td>
            <td id="err_email" class="eroare_text"></td>
        </tr>
        <tr>
            <td >Verificare email <font style="color: #F00; vertical-align: super;">*</font>:</td>
            <td><input type="text" name="email_verificare" id="email_verificare" value="<? if ( isset($_REQUEST['email']) ) echo $_REQUEST['email'];?>" size="30" class="input" /></td>
            <td id="err_email_verificare" class="eroare_text"></td>
        </tr>
        <tr><td colspan="3" align="left" class="sectiune_formular"><strong>Detalii contact (adresa de facturare)</strong></td></tr>

        <tr>
            <td >Adresa <font style="color: #F00; vertical-align: super;">*</font>:</td>
            <td><input type="text" name="adresa" id="adresa" value="<? if ( isset($_REQUEST['adresa']) ) echo $_REQUEST['adresa'];?>" size="30" class="input" /></td>
            <td id="err_adresa" class="eroare_text"></td>
        </tr>
        <tr>
            <td  valign="top">Cod postal:</td>
            <td>
                <input type="text" name="cod_postal" id="cod_postal" value="<? if ( isset($_REQUEST['cod_postal']) ) echo $_REQUEST['cod_postal'];?>" size="30" class="input" /><br>
                <a id="link_coduri" href="http://www.coduripostale.com" target="_blank" rel="nofollow" class="text_mic">Cauta codul tau postal</a>
            </td>
            <td id="err_cod_postal" valign="top"></td>
        </tr>                    
        <tr>
            <td >Localitate <font style="color: #F00; vertical-align: super;">*</font>:</td>
            <td><input type="text" name="localitate" id="localitate" size="30" value="<? if ( isset($_REQUEST['localitate']) ) echo $_REQUEST['localitate'];?>" class="input" /></td>
            <td id="err_localitate" class="eroare_text"></td>
        </tr>
        <tr>
            <td >Judet <font style="color: #F00; vertical-align: super;">*</font>:</td>
            <td>
                <select name="judet" id="judet" class="input">
                    <option value="0">-Alege-</option>
                    <?
                    include ("inc/global.php");
                    $str = "SELECT id,denumire FROM judete ORDER BY denumire";
                    $query = mysql_query($str);
                    while ( $rs = mysql_fetch_array($query) )
                    {
                        if ( isset($_REQUEST["judet"]) && $_REQUEST["judet"] == $rs[0] )
                        {
                            echo "<option selected value='".$rs[0]."'>".$rs[1]."</option>
                            ";
                        }
                        else
                        {
                             echo "<option value='".$rs[0]."'>".$rs[1]."</option>
                            ";
                        }
                    }
                    ?>
                </select>
            </td>
            <td id="err_judet" class="eroare_text"> </td>
        </tr>
        <tr>
            <td >Telefon <font style="color: #F00; vertical-align: super;">*</font>:</td>
            <td><input type="text" name="telefon" id="telefon" size="30" maxlength="10" value="<? if ( isset($_REQUEST['telefon']) ) echo $_REQUEST['telefon'];?>" class="input" onKeyPress="return checkIt(event)"/></td>
            <td id="err_telefon" class="eroare_text"></td>
        </tr>
        <tr>
            <td >Telefon mobil: </td>
            <td><input type="text" name="telefon_mobil" id="telefon_mobil" size="30" maxlength="10" value="<? if ( isset($_REQUEST['telefon_mobil']) ) echo $_REQUEST['telefon_mobil'];?>" class="input" onKeyPress="return checkIt(event)"/></td>
            <td id="err_telefon_mobil" class="eroare_text"></td>
        </tr>
        <tr>
            <td>Fax:</td>
            <td><input type="text" name="fax" id="fax" size="30" value="<? if ( isset($_REQUEST['fax']) ) echo $_REQUEST['fax'];?>" class="input" maxlength="10" onKeyPress="return checkIt(event)"/></td>
            <td id="err_fax" class="eroare_text"></td>
        </tr>
        <tr>
            <td colspan="3" align="left" class="sectiune_formular" style="display:none">
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td><strong>Sunt societate</strong></td>
                        <td><input type="checkbox" name="sunt_societate" id="sunt_societate" value="1" onclick="toggleContainer('date_soc');"  /></td>
                    </tr>
                </table>        
            </td>
        </tr>
        <tr>
        	 <td colspan="3">
        	 	<div id="date_soc" style="display:none" align="center">
			        <table cellpadding="2" cellspacing="0" width="100%">
			            <tr>
			                <td width="130" >Nume societate <font style="color: #F00; vertical-align: super;">*</font>:</td>
			                <td><input type="text" name="societate" id="societate" size="30" value="" class="input" /></td>
			                <td id="err_societate" width="250" class="eroare_text"></td>
			            </tr>
			            <tr>
			                <td >Cod fiscal <font style="color: #F00; vertical-align: super;">*</font>:</td>
			                <td><input type="text" name="cod_fiscal" id="cod_fiscal" size="30" value="" class="input" /></td>
			                <td id="err_cod_fiscal" class="eroare_text"></td>
			            </tr>
			            <tr>
			                <td>Nr. Reg. Comert:</td>
			                <td><input type="text" name="nr_reg_comert" id="nr_reg_comert" size="30" value="" class="input" /></td>
			                <td id="err_nr_reg_comert" class="eroare_text"></td>
			            </tr>
			            <tr>
			                <td>Banca:</td>
			                <td><input type="text" name="banca" id="banca" size="30" value="" class="input" /></td>
			                <td id="err_banca" class="eroare_text"></td>
			            </tr>
			            <tr>
			                <td>Cod IBAN:</td>
			                <td><input type="text" name="cod_iban" id="cod_iban" size="30" value="" class="input" /></td>
			                <td id="err_cod_iban" class="eroare_text"></td>
			            </tr>            
			        </table>        
			    </div>	
        	 </td>
        </tr>
        <tr>
        	<td colspan="3">
        		<table width="100%">
			        <tr><td colspan="2" class="line"></td></tr>
			        <tr><td colspan="2" style="padding:5px"><font style="color: #F00; vertical-align: super;">*</font> = Campuri obligatorii</td></tr>
			        <tr>
			            <td width="130"></td>
			            <td align="left" style="padding:5px">
			            	<input type="hidden" id="salvez" name="salvez" value="">
			                <input type="button" onclick="if ( checkForm() ) { document.getElementById('form_cont').submit(); }" name="creaza_cont" id="creaza_cont" value="CREEAZA CONT" class="submit" />
			            </td>
			        </tr>        
			    </table>
        	</td>
        </tr>
    </table>
</form>
</body>
</html>
<?
	}
?>