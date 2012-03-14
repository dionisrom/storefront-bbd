<?php
session_start();
if (isset($_REQUEST["usrid"]) && isset($_REQUEST["passwd"]) )
{
	include ('inc/global.php');
	$sql = "SELECT * FROM useri WHERE usr = '".$_REQUEST["usrid"]."' and par like md5('".$_REQUEST["passwd"]."')";
	$query = mysql_query($sql) or die("<script>alert('Eroare preluare date utilizator.!');</script>");
	$path = substr($_SERVER['REQUEST_URI'],0,strrpos($_SERVER['REQUEST_URI'],"/"));
	//echo "<script>alert('http://".$_SERVER['SERVER_NAME'].$path."');</script>";
	if ( mysql_num_rows($query)>0 )
	{
		$rs = mysql_fetch_array($query);
		$_SESSION["err"] = "fara";
		if ( $rs[14] == 0 )
		{
			$_SESSION["err"] = "Utilizatorul nu a fost validat!";
		}

		if ( $_SESSION["err"] != "fara")
		{
			$body = "
			<script>
				alert('".$_SESSION["err"]."');
				window.location.assign('index.php');
			</script>
			";
		}
		else
		{
			$_SESSION["merge"] = 1;
			$_SESSION["user"] = $rs["usr"];
			$_SESSION["id_user"] = $rs[0];
			$_SESSION["nume"] = $rs["nume"]." ".$rs["prenume"];
			$_SESSION["mesaj_auth"]= "Bine ai revenit <br>".$rs["nume"]." ".$rs["prenume"]." !";
			$_SESSION["id"] = $_REQUEST["sessid"];
			$_SESSION["auth"] = "da";
			$_SESSION["tipusr"] = $rs["id_tip"];
			$body = "
			<script>
				window.location.assign('index.php');
			</script>
			";
		}
	}
	else
	{
		$body = "
		<script>
			alert('Autentificare esuata! Va rugam sa reincercati !');
			window.location.assign('index.php');
		</script>
		";	
	}
} 
?>
<html>
<head>
</head>
<body>
	<?php echo $body;?>
</body>
</html>