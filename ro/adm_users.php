<?
session_start();
if ( isset($_SESSION["auth"]) && $_SESSION["auth"] == "da" && ( $_SESSION["tipusr"] == 1 || $_SESSION["tipusr"] == 2 ) )
{
    
include ("../inc/global.php");
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
        $str .= " cod_postal = '".$_REQUEST["cod_postal"]."', ";
        $str .= " telefon_mobil = '".$_REQUEST["telefon_mobil"]."', ";
        $str .= " fax = '".$_REQUEST["fax"]."' ";
        $str .= "WHERE id = ".$_REQUEST["iduser"];
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
            <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
			<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
			<script type="text/javascript">
				$(window).load(function(){
					$("#main_frame",window.parent.document).height($(document).height());
				});    
			</script>
        </head>
        <body>
            <div class="titlu_mic">'.$mesaj.'</div>
        </body>
        </html>
        ';
}
if ( !isset($_REQUEST["salvez"]) && !isset($_REQUEST["cauta"]) )
{
    $str_caut = "SELECT * FROM useri ORDER BY usr";
    $rsqcaut = mysql_query($str_caut) or die("Eroare preluare utilizatori!");
    $optiuni = "<select id='iduser' name='iduser' class='input' multiple='20'>\n";
    while ( $rscaut = mysql_fetch_array($rsqcaut) )
    {
        $optiuni .= "<option value='".$rscaut[0]."'>".$rscaut[9]." (".$rscaut[1]." ".$rscaut[2].") </option>\n";
    }
    $optiuni .= "</select>";
    echo '
        <html>
        <head>
            <title>Modificare informatii cont utilizator</title>
            <meta http-equiv="Pragma" content="no-cache">
            <meta http-equiv="Cache-Control" content="no-cache">
            <meta name="description" content="Ortoprotetica - Modificare informatii cont utilizator">
            <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
            <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css"> 
			<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
			<script type="text/javascript">
				$(window).load(function(){
					$("#main_frame",window.parent.document).height($(document).height());
				});    
			</script>
        </head>
        <body>
            <div class="titlu_pag">Cauta utilizator pentru administrare date personale</div>
            <br><br>
            <form target="_self">
                <table border=0>
                <tr>
                    <td valign="top">Cauta : </td>
                    <td valign="top">'.$optiuni.'</td>
                </tr>
                <tr>
                    <td colspan=2 align="center">
                        <input type="hidden" id="cauta" name="cauta" value="caut">
                        <input type="submit" class="submit" value="Modifica">
                    </td>
                </tr>
                </table>
            </form>
        </body>
        </html>
        ';
}
if ( !isset($_REQUEST["salvez"]) && isset($_REQUEST["cauta"]) && $_REQUEST["cauta"] == "caut" )
{
$str_modif = "SELECT * FROM useri WHERE id = ".$_REQUEST["iduser"];
$qmodif = mysql_query($str_modif);
$rsi = mysql_fetch_array($qmodif);
?>
<html>
<head>
    <title>Modificare cont utilizator</title>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="description" content="Ortoprotetica - Modificare cont utilizator">
    <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
    <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
	<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
	<script type="text/javascript">
		$(window).load(function(){
			$("#main_frame",window.parent.document).height($(document).height());
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
    <script language="JavaScript" src="../js/md5.js"></script>
    <script>
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
                    include ("../inc/global.php");
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
                            <input type="hidden" id="iduser" name="iduser" value="<?=$_REQUEST["iduser"]?>">
                            <input type="button" onclick="document.getElementById('form_cont').submit();" name="modif_cont" id="modif_cont" value="MODIFICA CONT" class="submit" />
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
}
?>