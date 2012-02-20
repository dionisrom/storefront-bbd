<?
session_start();

include ("inc/global.php");
if ( isset($_REQUEST["salvez"]) && $_REQUEST["salvez"] == "da" )
{
	    //echo "Primire date - in lucru !";
        $str = "UPDATE useri SET";
        $str .= " nume = '".$_REQUEST["nume"]."', ";
        $str .= " prenume ='".$_REQUEST["prenume"]."', ";
        $str .= " id_judet = ".$_REQUEST["judet"].", ";
        $str .= " adresa = '".$_REQUEST["adresa"]."', ";
        $str .= " telefon = '".$_REQUEST["telefon"]."', ";
        $str .= " email = '".$_REQUEST["email"]."', ";
        if ( $_REQUEST["parolav"] != "" && $_REQUEST["parola"] != "" && $_REQUEST["parola_verificare"] != "" && $_REQUEST["parola"] == $_REQUEST["parola_verificare"] ) 
        {
        	$str .= " par = '".md5($_REQUEST["parola"])."', ";
		}
        $str .= " cod_postal = '".$_REQUEST["cod_postal"]."', ";
        $str .= " telefon_mobil = '".$_REQUEST["telefon_mobil"]."', ";
        $str .= " fax = '".$_REQUEST["fax"]."' ";
        $str .= "WHERE id = ".$_SESSION["id_user"];
        //echo $str;
        mysql_query($str) or die ("Sistemul a generat o eroare la salvarea datelor!<br>".$str."<br>".mysql_error());
        //echo $str;
        $mesaj = "Informatiile referitoare la contul dumneavoastra au fost salvate cu succes !";
        echo '
        <html>
        <head>
            <title>Modificare informatii cont utilizator</title>
            <meta http-equiv="Pragma" content="no-cache">
            <meta http-equiv="Cache-Control" content="no-cache">
            <meta name="description" content="Ortoprotetica - Modificare informatii cont utilizator">
            <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
            <LINK HREF="css/default.css" REL="stylesheet" TYPE="text/css">    
        </head>
        <body>
            <div class="titlu_mic">'.$mesaj.'</div>
        </body>
        </html>
        ';
}
else
{
$str_modif = "SELECT * FROM useri WHERE id = ".$_SESSION["id_user"];
$qmodif = mysql_query($str_modif);
$rsi = mysql_fetch_array($qmodif);
?>
<html>
<head>
	<title>Modificare cont utilizator</title>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="author" content="Bajanica Bogdan Dionisie">
    <meta name="description" content="Ortoprotetica - Modificare cont utilizator">
    <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
    <LINK HREF="css/default.css" REL="stylesheet" TYPE="text/css">
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
    <script language="JavaScript" src="js/md5.js"></script>
	<script language="JavaScript">

	// check form values
	function checkForm()
	{
        var nume = "";
        for (i=0;i<document.forms[0].elements.length;i++)
        {
            nume = "err_"+document.forms[0].elements[i].id;
            //alert(nume+"-"+typeof(document.getElementById(nume)) );
            if ( nume != "err_link_coduri" && nume != "err_sunt_societate" && nume != "err_salvez" && nume != "err_modif_cont" )
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
		if ( !fv.isEmpty(document.forms[0].elements[0].value) && MD5( document.forms[0].elements[0].value ) == '<?=$rsi[10]?>' )
		{
	        // check for empty parola noua field
	        if (!fv.isEmpty(document.forms[0].elements[1].value) )
	        {
		        // check for parola noua este parola de verificare 
		        if ( !fv.isEmpty(document.forms[0].elements[2].value) && document.forms[0].elements[2].value != document.forms[0].elements[1].value )
		        {
		            fv.raiseError("Parola noua este diferita de parola verificare! ");
		            document.getElementById("err_"+document.forms[0].elements[2].id).innerHTML="Parola noua este diferita de parola verificare! ";
		        }
		        
		        // check for empty parola de verificare field
		        if ( fv.isEmpty(document.forms[0].elements[2].value) )
		        {
		            fv.raiseError("Va rog introduceti parola de verificare!");
		            document.getElementById("err_"+document.forms[0].elements[2].id).innerHTML="Va rog introduceti parola de verificare!";
		        }
	        }	
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
             
        // check for empty adresa field
        if (fv.isEmpty(document.forms[0].elements[6].value))
        {
            fv.raiseError("Va rog introduceti adresa !");
            document.getElementById("err_"+document.forms[0].elements[6].id).innerHTML="Va rog introduceti adresa !";
        }
        
        // check for empty localitate field
        if (fv.isEmpty(document.forms[0].elements[8].value))
        {
            fv.raiseError("Va rog introduceti localitatea !");
            document.getElementById("err_"+document.forms[0].elements[8].id).innerHTML="Va rog introduceti localitatea !";
        }
        
        // check for empty judet field
        if ( document.forms[0].elements[9].selectedIndex==0 )
        {
            fv.raiseError("Va rog selectati judetul !");
            document.getElementById("err_"+document.forms[0].elements[9].id).innerHTML="Va rog selectati judetul !";
        }
        
        // check for empty telefon field
        if (fv.isEmpty(document.forms[0].elements[10].value))
        {
            fv.raiseError("Va rog introduceti numarul dumneavoastra de telefon !");
            document.getElementById("err_"+document.forms[0].elements[10].id).innerHTML="Va rog introduceti numarul dumneavoastra de telefon !";
        }
        
        // check for valid telefon field
        if ( !fv.isEmpty(document.forms[0].elements[10].value) && document.forms[0].elements[10].value.length != 10 )
        {
            fv.raiseError("Va rog introduceti un numar de telefon valid! (lungime diferita de 10 cifre)");
            document.getElementById("err_"+document.forms[0].elements[10].id).innerHTML="Va rog introduceti un numar de telefon valid ! (lungime diferita de 10 cifre)";
        }
        
        // check for valid telefon mobil field
        if ( !fv.isEmpty(document.forms[0].elements[12].value) && document.forms[0].elements[11].value.length != 10 )
        {
            fv.raiseError("Va rog introduceti un numar de telefon mobil valid! (lungime diferita de 10 cifre)");
            document.getElementById("err_"+document.forms[0].elements[11].id).innerHTML="Va rog introduceti un numar de telefon mobil valid ! (lungime diferita de 10 cifre)";
        }
        
        // check for valid fax field
        if ( !fv.isEmpty(document.forms[0].elements[12].value) && document.forms[0].elements[12].value.length != 10 )
        {
            fv.raiseError("Va rog introduceti un numar de fax valid! (lungime diferita de 10 cifre)");
            document.getElementById("err_"+document.forms[0].elements[12].id).innerHTML="Va rog introduceti un numar de fax valid ! (lungime diferita de 10 cifre)";
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
<div class="titlu_pag">Modificare informatii utilizator</div>
<form target="_self" method="post" id="form_cont" name="form_cont">
    <table cellpadding="2" cellspacing="0" style="white-space:nowrap;">                    
        <tr><td colspan="3" align="left" class="sectiune_formular"><strong>Detalii cont</strong></td></tr>
        <tr>
            <td >Parola veche :</td>
            <td><input type="password" name="parolav" id="parolav" value="" size="30" maxlength="30" class="input" /></td>
            <td id="err_parolav" class="eroare_text"></td>
        </tr>
        <tr>
            <td >Parola noua :</td>
            <td><input type="password" name="parola" id="parola" value="" size="30" maxlength="30" class="input" /></td>
            <td id="err_parola" class="eroare_text"></td>
        </tr>
        <tr>
            <td >Verificare parola noua :</td>
            <td><input type="password" name="parola_verificare" id="parola_verificare" value="" size="30" maxlength="30" class="input" /></td>
            <td id="err_parola_verificare" class="eroare_text"></td>
        </tr>
        <tr><td colspan="3" align="left" class="sectiune_formular"><strong>Detalii personale</strong></td></tr>
        <tr>
            <td >Nume :</td>
            <td><input type="text" name="nume" id="nume" value="<?=$rsi[1]?>" size="30" class="input" /></td>
            <td id="err_nume" class="eroare_text"></td>
        </tr>
        <tr>
            <td >Prenume :</td>
            <td><input type="text" name="prenume" id="prenume" value="<?=$rsi[2]?>" size="30" class="input" /></td>
            <td id="err_prenume" class="eroare_text"></td>
        </tr>
        <tr>
            <td >Email :</td>
            <td><input type="text" name="email" id="email" size="30" value="<?=$rsi[6]?>" class="input" /></td>
            <td id="err_email" class="eroare_text"></td>
        </tr>
        <tr><td colspan="3" align="left" class="sectiune_formular"><strong>Detalii contact (adresa de facturare)</strong></td></tr>

        <tr>
            <td >Adresa :</td>
            <td><input type="text" name="adresa" id="adresa" value="<?=$rsi[4]?>" size="30" class="input" /></td>
            <td id="err_adresa" class="eroare_text"></td>
        </tr>
        <tr>
            <td  valign="top">Cod postal :</td>
            <td>
                <input type="text" name="cod_postal" id="cod_postal" value="<?=$rsi[11]?>" size="30" onKeyPress="return checkIt(event)" class="input" /><br>
                <a id="link_coduri" href="http://www.coduripostale.com" target="_blank" rel="nofollow" class="text_mic">Cauta codul tau postal</a>
            </td>
            <td id="err_cod_postal" valign="top"></td>
        </tr>                    
        <tr>
            <td >Localitate :</td>
            <td><input type="text" name="localitate" id="localitate" size="30" value="<?=$rsi[16]?>" class="input" /></td>
            <td id="err_localitate" class="eroare_text"></td>
        </tr>
        <tr>
            <td >Judet :</td>
            <td>
                <select name="judet" id="judet" class="input">
                    <option value="0">-Alege-</option>
                    <?
                    include ("inc/global.php");
                    $str = "SELECT id,denumire FROM judete ORDER BY denumire";
                    $query = mysql_query($str);
                    while ( $rs = mysql_fetch_array($query) )
                    {
                        if ( $rsi[3] == $rs[0] )
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
            <td >Telefon :</td>
            <td><input type="text" name="telefon" id="telefon" size="30" maxlength="10" value="<?=$rsi[5]?>" class="input" onKeyPress="return checkIt(event)"/></td>
            <td id="err_telefon" class="eroare_text"></td>
        </tr>
        <tr>
            <td >Telefon mobil :</td>
            <td><input type="text" name="telefon_mobil" id="telefon_mobil" size="30" maxlength="10" value="<?=$rsi[12]?>" class="input" onKeyPress="return checkIt(event)"/></td>
            <td id="err_telefon_mobil" class="eroare_text"></td>
        </tr>
        <tr>
            <td>Fax :</td>
            <td><input type="text" name="fax" id="fax" size="30" value="<?=$rsi[13]?>" class="input" maxlength="10" onKeyPress="return checkIt(event)"/></td>
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
			                <td width="130" >Nume societate *:</td>
			                <td><input type="text" name="societate" id="societate" size="30" value="" class="input" /></td>
			                <td id="err_societate" width="250" class="eroare_text"></td>
			            </tr>
			            <tr>
			                <td >Cod fiscal *:</td>
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
			        <tr>
			            <td width="130"></td>
			            <td align="left" style="padding:5px">
			            	<input type="hidden" id="salvez" name="salvez" value="da">
			                <input type="button" onclick="if ( checkForm() ) { document.getElementById('form_cont').submit(); }" name="modif_cont" id="modif_cont" value="MODIFICA CONT" class="submit" />
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