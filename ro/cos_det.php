<?php
  session_start();
  echo '
  <html>
	<head>
		<title>Detalii cos</title>
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Cache-Control" content="no-cache">
		<meta name="description" content="Ortoprotetica - Detalii cos">
		<meta name="copyright" content="&copy; 2012 Ortoprotetica" />
		<LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
		<script type="text/javascript">
			$(window).load(function(){
				$("#main_frame",window.parent.document).height($("html").height()+20); $("#body",window.parent.document).height($("html").height()+30);
			});    
		</script>
		<script>
			function adaug_tr(tip,total)
			{
				if ( tip == 1 )
				{
					document.getElementById(\'nume_tr\').innerHTML = \'Cargus\';
					document.getElementById(\'tr_cant\').innerHTML = \'1\';
					document.getElementById(\'trftva\').innerHTML = \'25\';
					document.getElementById(\'trtva\').innerHTML = \'25\';
					document.getElementById(\'total_fact\').innerHTML = 25 + total;
				}
				if ( tip == 0 )
				{
					document.getElementById(\'nume_tr\').innerHTML = \'Posta Romana\';
					document.getElementById(\'tr_cant\').innerHTML = \'1\';
					document.getElementById(\'trftva\').innerHTML = \'12\';
					document.getElementById(\'trtva\').innerHTML = \'12\';
					document.getElementById(\'total_fact\').innerHTML = 12 + total;
				}
                document.getElementById(\'curier\').value = tip;
				
			}
		</script>	
	</head>
	<body>
		<div class="titlu_pag">
			Detalii cos de cumparaturi
		</div>
  ';
  if ( $_SESSION["cos"] == "plin" )
  {
  	$tabel = "<table cellspacing=0 cellpadding=8 border=0>
  	<tr>
  		<th align=center>Nume produs</th>
  		<th align=center>Cant.</th>
  		<th align=center>Masura</th>
  		<th align=center>Pret unitar<br>(cu TVA)</th>
  		<th align=center>Pret total<br>(cu TVA)</th>
  	</tr>";
  	include("../inc/global.php");
  	$total = 0;
  	for ($i=0;$i<$_SESSION["nr_produse"];$i++ )
  	{
		$arr_temp = explode("_",$_SESSION["id_produse"][$i]);
		$sql_denprod = "SELECT nume FROM produse WHERE id = ".$arr_temp[0];
		$q_denprod = mysql_query($sql_denprod) or die ("Eroare preluare denumire produs!") ;
		$rs_denprod = mysql_fetch_array($q_denprod);
		
		$tabel .= "
		<tr>
			<td align=left>
				<a title='Detalii produs' href='javascript:;' onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=1&id_produs=".$_SESSION["id_produse"][$i]."';\">".$rs_denprod[0]."</a>
			</td>
			<td align=center>
				".$_SESSION["cant_produse"][$i]."
			</td>
			<td align=center>
				".$_SESSION["masura_produse"][$i]."
			</td>
			<td align=right>
				".$_SESSION["pret_produse"][$i]."
			</td>
			<td align=right>
				".round($_SESSION["cant_produse"][$i]*$_SESSION["pret_produse"][$i],2)."
			</td>
		</tr>
		";
		$total += round($_SESSION["cant_produse"][$i]*$_SESSION["pret_produse"][$i],2);
		//mysql_close($q_denprod);
  	}
  	$tabel .= "
  		<tr>
  			<td align=left id='nume_tr'>Posta Romana</td>
  			<td align=center id='tr_cant'>1</td>
  			<td align=center></td>
  			<td align=right id='trftva'>12</td>
  			<td align=right id='trtva'>12</td>
  		</tr>
  		<tr>
  			<td colspan=4 align=center>
  				Selectati firma de transport:
  				<select class='input' onchange='adaug_tr(this.value,$total)'>
  					<option value=0>Posta Romana: 12 lei ( 2-5 zile )</option>
  					<option value=1>Cargus: 25 lei ( 72 ore )</option>
  				</select>
                <input type='hidden' id='curier' name='curier' value=0>
  				<br>Termenele de livrare curg de la data validarii comenzii !
  			</td>
  		</tr>
  		<tr>
  			<td colspan=3 align=center style='font-size:14pt; color: #900;'>TOTAL</td>
  			<td id='total_fact' align=right style='border:1px solid #CCC; font-size:14pt; color: #900; background: url(../images/bg_header_galben.png);background-position:bottom;'>".($total+12)."</td>
  		</tr>
  	</table>
  	<br>";
  	if ( !isset($_SESSION["auth"]) )
  	{
  		$tabel .= "<div class='atentionare' width=90%>
  			Pentru a putea finaliza achizitia de produse trebuie sa fiti autentificat !<br>
  			In cazul in care aveti cont pe site-ul nostru va rugam sa va autentificati !<br>
  			In cazul in care nu aveti cont va rugam sa va creati unul apasand <a href='javascript:;' onclick=\"top.document.getElementById('main_frame').src='./contnou.php';\">aici</a> !
  		</div>
  		";
	}
	else
	{
		$tabel .= "<center><input type='button' value='Finalizeaza' class='submit' onclick=\"top.document.getElementById('main_frame').src='final_cos.php?curier='+document.getElementById('curier').value\"></center>";
	}
  	echo $tabel;
  }
  
  else
  {
	  echo "Cosul dumneavoastra este gol !";
  }
  echo 
  '
  </body>
  </html>
  ';
  
?>
