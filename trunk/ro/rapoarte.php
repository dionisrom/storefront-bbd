<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Rapoarte</title>
		<LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
		<script type="text/javascript">
			$(window).load(function(){
				$("#main_frame",window.parent.document).height($(document).height());
			});    
		</script>
    </head>
    <body>
		<?php
		include("../inc/global.php");
		$sql = "SELECT * FROM cos WHERE validat = 1";
		$query = mysql_query($sql) or die("<script>alert('Eroare la preluare informatii cosuri.');</script>");
		$comenzi = "<table id='comenzi' border=1 cellpadding=3 cellspacing=0 style=\"border:1px solid #EFEFEF; margin: 5px; padding: 3;\">";
		$comenzi .= "
		<tr>
			<th>Nr. comanda</th>
			<th>Data comanda</th>
			<th>Ora comanda</th>
			<th>Data validare</th>
			<th>Ora validare</th>
			<th>Total comanda</th>	
		</tr>";
		while ($row = mysql_fetch_array($query))
		{
			$total_comanda = 0;
			$cantitati = explode(",",$row["cantitati"]);
			$preturi = explode(",",$row["preturi"]);
			$produse = explode(",", $row["produse"]);
			$masuri = explode(",", $row["masuri"]);
			foreach ($produse as $key => $value)
			{
				$cant[$value] = $cantitati[$key];
				$pret[$value] = $preturi[$key];
			}
			$rs_detalii = "SELECT * FROM produse WHERE id IN (".$row["produse"].")";
			$query_detalii = mysql_query($rs_detalii) or die("<script>alert('Eroare preluare detalii produse!')</script>");
			$i = 0;
			$detalii = "<table border=1 id='detalii_comanda_".$row["id"]."' cellpadding=4 cellspacing=0 style=\"border:1px solid #EFEFEF; margin: 5px; padding: 3;\">";
			$detalii .= "<tr>";
			$detalii .= "<th>Nume produs</th>";
			$detalii .= "<th>cant</th>";
			$detalii .= "<th>masura</th>";
			$detalii .= "<th>pret unitar</th>";
			$detalii .= "<th>valoare</th>";
			$detalii .= "</tr>";
			while ($row_detalii = mysql_fetch_array($query_detalii))
			{
				$id = $row_detalii["id"];
				$detalii .= "<tr>";
				$detalii .= "<td>".$row_detalii["nume"]."</td>";
				$detalii .= "<td>".$cant["$id"]."</td>";
				$detalii .= "<td>".$masuri["$id"]."</td>";
				$detalii .= "<td>".$pret["$id"]."</td>";
				$detalii .= "<td>".($cant["$id"]*$pret["$id"])."</td>";
				$total_comanda += $cant["$id"]*$pret["$id"];
				$detalii .= "</tr>";
				$i++;
			}
			$detalii .= "</table>";
			
			$comenzi .= "
				<tr id='comanda_".$row["id"]."'>
					<td class='id_comanda'>".$row["id"]."</td>
					<td class='data_comanda'>".$row["data"]."</td>
					<td class='ora_comanda'>".$row["ora"]."</td>
					<td class='data_validare_comanda'>".$row["data_validare"]."</td>
					<td class='ora_validare_comanda'>".$row["ora_validare"]."</td>
					<td><span class='red'>".$total_comanda."</span></td>	
				</tr>
				<tr id='detalii_".$row[$id]."'>
					<td colspan='6' style='text-align: center;'>
					".$detalii."
					</td>
				</tr>
				";
		}
		$comenzi .= "</table>";
		echo "<h3>Detalii comenzi inchise</h3>".$comenzi;
		?>
    </body>
</html>
