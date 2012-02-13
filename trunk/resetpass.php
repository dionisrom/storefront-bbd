<?
session_start();
date_default_timezone_set('Europe\Bucharest');
$email_existent = false;
$eroare = "";
function isValidEmail($email)
{
	  // First, we check that there's one @ symbol, and that the lengths are right
	 if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
	 // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
	 	return false;
	 }
	 // Split it into sections to make life easier
	 $email_array = explode("@", $email);
	 $local_array = explode(".", $email_array[0]);
	 for ($i = 0; $i < sizeof($local_array); $i++) {
		 if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
	 		return false;
		 }
	 }
	 if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
	 	$domain_array = explode(".", $email_array[1]);
		 if (sizeof($domain_array) < 2) {
	 		return false; // Not enough parts to domain
		 }
		 for ($i = 0; $i < sizeof($domain_array); $i++) {
			 if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
			 	return false;
			 }
		 }
	 }
	 return true;
}

if ( isset($_REQUEST["passwdnou"]) && isset($_REQUEST["email"]) )
{
	$query = mysql_query("SELECT id FROM useri WHERE email like '".$_REQUEST["email"]."' ");
    if ( mysql_numrows($query) == 0 )
	{
		$email_existent = false;
		$eroare = "Adresa de email inexistenta !";
	}
	if ( mysql_numrows($query) == 1 )
	{
		$email_existent = true;
	}
	if ( !isValidEmail($_REQUEST["email"]) )
	{
		$eroare = "Adresa de email este invalida !";
	}
}

if ( isset($_REQUEST["passwdnou"]) && $_REQUEST["passwdnou"] == "da" && isset($_REQUEST["email"]) && $email_existent && isValidEmail($_REQUEST["email"]) && $eroare=="" )
{
	include("inc/random.php"); 
	$parola = get_rand_id(10);
	if ( $email_existent && isValidEmail($_REQUEST["email"]) )
	{	
		$headers = 'From: webmaster@pretuimsanatatea.ro' . "\n" .
	    'Reply-To: webmaster@pretuimsanatatea.ro' . "\n" .
	    'X-Mailer: PHP/' . phpversion().
	    'MIME-Version: 1.0' . "\n".
		'Content-type: text/html; charset=iso-8859-1' . "\n";
		$header1 =  'X-Mailer: PHP/' . phpversion().
	    'MIME-Version: 1.0' . "\n".
		'Content-type: text/html; charset=iso-8859-1' . "\n";
		mail($_REQUEST["email"],"Resetare parola site Medical Active (www.pretuimsanatatea.ro)","Noua parola pentru a va putea autentifica pe site-ul www.pretuimsanatatea.ro este <b><i>".$parola."</i></b>",$headers) ;
		mail("webmaster@pretuimsanatatea.ro","Resetare parola site Medical Active (www.pretuimsanatatea.ro)","Userul cu emailul <b><i>".$_REQUEST["email"]." si-a schimbat parola ".date("d.m.Y H:i:s", time() )." ! ",$header1) ;
		echo'
		<html>
		<head>
			<title>Resetare parola utilizator</title>
		    <meta http-equiv="Pragma" content="no-cache">
		    <meta http-equiv="Cache-Control" content="no-cache">
		    <meta name="description" content="Medical Active - Resetare parola utilizator">
		    <meta name="copyright" content="&copy; 2009 Medical Active SRL" />
		    <LINK HREF="css/default.css" REL="stylesheet" TYPE="text/css">	
		</head>
		<body>
			<div class="titlu_mic">A fost trimis un email la dresa ".$_REQUEST["email"]." ! <br>Va rgum cautati si in folderul SPAM sau JUNK al cautei de email!</div>
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
	<title>Resetare parola utilizator</title>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="description" content="Medical Active - Resetare parola utilizator">
    <meta name="copyright" content="&copy; 2009 Medical Active SRL" />
    <LINK HREF="css/default.css" REL="stylesheet" TYPE="text/css">
</head>
<body>
	<div class="titlu_pag">Resetare parola utilizator</div>
	<center>
		<form action="resetpass.php" target="_self" method="post">
        	<table cellpadding="2" cellspacing="0">                    
		        <tr><td colspan="2" align="left" class="sectiune_formular"><strong>Introduceti adresa dumneavoastra de email</strong></td></tr>
		        <tr>
		            <td width="130" >Adresa email *:</td>
		            <td><input type="text" name="email" id="email" value="" size="30" maxlength="32" class="input" />&nbsp;<font id="err_email" name="err_email" class="eroare_text"><? echo $eroare;?></font></td>
		        </tr>
				<tr>
				    <td width="130"></td>
				    <td align="left" style="padding:5px">
				    	<input type="hidden" id="passwdnou" name="passwdnou" value="da">
				        <input type="submit" name="creaza_cont" value="Resetare parola" class="submit" />
				    </td>
				</tr>		        
			</table>
		</form>
	</center>
</body>
</html>
<?
}
?>