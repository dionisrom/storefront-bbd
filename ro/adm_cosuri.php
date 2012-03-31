<?php
  session_start();
  $edit_cosuri = "";
  if ( isset($_SESSION["auth"]) && $_SESSION["auth"] == "da" && ( $_SESSION["tipusr"] == 1 || $_SESSION["tipusr"] == 2 ) )
  {
?>
<html>
<head>
	<title>Administrare cosuri</title>
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta name="author" content="Bajanica Bogdan Dionisie">
	<meta name="description" content="Ortoprotetica - Administrare cosuri">
	<meta name="copyright" content="&copy; 2012 Ortoprotetica" />
	<LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
	<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
    <script>
        function ch_tr(id, elem, total)
        {
            valsel = elem.options[elem.selectedIndex].value;
            total = Number( document.getElementById('total_tabel_'+id+'').innerHTML.substr( 4, (document.getElementById('total_tabel_'+id+'').innerHTML.length-9) ));
            
            if ( valsel == 0 )
            {
                document.getElementById('pretu_'+id+'_tr').value = 12;
                document.getElementById('val_'+id+'_tr').value = 12;
                sumat = total + 12 - 25;
                document.getElementById('total_tabel_'+id+'').innerHTML = "<h3>"+sumat+"</h3>";
                
            }
            if ( valsel == 1 )
            {
                document.getElementById('pretu_'+id+'_tr').value = 25;
                document.getElementById('val_'+id+'_tr').value = 25;
                sumat = total + 25 - 12;
                document.getElementById('total_tabel_'+id+'').innerHTML = "<h3>"+sumat+"</h3>";
            }
        }
        
        function add_cant( id, linie, pret)
        {
            total = Number(document.getElementById('total_tabel_'+id+'').innerHTML.substr( 4, (document.getElementById('total_tabel_'+id+'').innerHTML.length-9) ));
            total = total.toFixed(2);
            pretu = Number(pret);
            document.getElementById('cant_'+id+'_'+linie).value = parseInt(document.getElementById('cant_'+id+'_'+linie).value) + 1;
            val_elem = Number(document.getElementById('val_'+id+'_'+linie).value);
            val_elem += Number(pretu);
            document.getElementById('val_'+id+'_'+linie).value = val_elem.toFixed(2);
            sumat = Number(total) + Number(pretu);
            sumat = sumat.toFixed(2);
            document.getElementById('total_tabel_'+id+'').innerHTML = "<h3>"+sumat+"</h3>";    
        }
        
        function min_cant( id, linie, pret)
        {
            if ( parseInt(document.getElementById('cant_'+id+'_'+linie).value) >= 1 )
            {
                total = Number( document.getElementById('total_tabel_'+id+'').innerHTML.substr( 4, (document.getElementById('total_tabel_'+id+'').innerHTML.length-9) ) );
                total = total.toFixed(2);
                pretu = Number(pret);
                document.getElementById('cant_'+id+'_'+linie).value = parseInt(document.getElementById('cant_'+id+'_'+linie).value) - 1;
                val_elem = Number(document.getElementById('val_'+id+'_'+linie).value);
                val_elem -= pretu.toFixed(2);
                document.getElementById('val_'+id+'_'+linie).value = val_elem.toFixed(2);
                sumat = total - pretu;
                sumat = sumat.toFixed(2);
                document.getElementById('total_tabel_'+id+'').innerHTML = "<h3>"+sumat+"</h3>";        
            }
        }
    </script>
</head>
<body>
	<div class="titlu_pag">Administrare cosuri</div>
			<?
			include("../inc/global.php");
			$sql_cosuri = "SELECT a.data, a.ora, a.produse, a.cantitati, b.usr, b.nume, b.prenume, a.id, c.denumire, b.localitate, b.adresa, b.cod_postal, b.telefon, b.email, b.telefon_mobil, b.fax, a.curier, a.masuri FROM cos a, useri b, judete c WHERE a.validat = 0 and b.id = a.id_user and c.id = b.id_judet ORDER BY a.id";
			$q_cosuri = mysql_query($sql_cosuri) or die("Eroare la preluare cosuri pentru validare!<br>".mysql_error());
			$gr_total = 0;
			$detalii_cosuri = "";
			if (mysql_num_rows($q_cosuri))
			{
                ?>
                <table border="0" cellpadding="5" cellspacing="0" style="padding-bottom: 600px;">
                    <tr>
                        <th>Operatiuni</th>
                        <th>Data si ora</th>
                        <th>User</th>
                        <th>Nume user</th>
                        <th>Denumire produs</th>
                        <th>Cantitate</th>
                        <th>Pret unitar</th>
                        <th>Masura</th>
                        <th>Pret total</th>
                    </tr>
                <?
				$linie=0;
				 
				while ( $rs_cos = mysql_fetch_array($q_cosuri) )
				{
					$prod_arr = explode(",",$rs_cos[2]);
					$produse = array();
					foreach ($prod_arr as $value) {
						$id_produs = explode("_", $value);
						$produse[] = $id_produs[0];
					}
					$cant_arr = explode(",",$rs_cos[3]);
					$masuri_arr = explode(",",$rs_cos["masuri"]);
					$span = " rowspan=".(count($prod_arr));
					$class="";
					if ($linie%2)
				        $class="class=odd";
				    else
				    	$class="class=even";
					echo "
					<tr ".$class.">
						<td".$span." align=center>
							<img border=1 src='../ico/flag-finish.png' title='Finalizeaza cosul!' onmouseover=\"this.style.cursor='pointer';\" onclick=\"document.getElementById('detalii_cos_".$rs_cos[7]."').style.display='block';\">
                            <img border=1 src='../ico/edit_cos.png' title='Editeaza cosul' onmouseover=\"this.style.cursor='pointer';\" onclick=\"document.getElementById('editeaza_cos_".$rs_cos[7]."').style.display='block';\">
                            <br><img border=1 src='../ico/delete_cos.png' title='Sterge cosul' onmouseover=\"this.style.cursor='pointer';\" onclick=\"if ( confirm('Sunteti sigur ca doriti sa stergeti acest cos?') ) document.getElementById('modif_cos').src='sterg_cos.php?idcos=".$rs_cos[7]."';\">
						</td>
						<td".$span." align='center'>".$rs_cos[0]."<br>".$rs_cos[1]."</td>
						<td".$span.">".$rs_cos[4]."</td>
						<td".$span.">".$rs_cos[5]." ".$rs_cos[6]."</td>";
					$sql_prod = "SELECT nume, pret, reducere FROM produse WHERE id IN (".implode(",",$produse).")";
					$q_prod = mysql_query($sql_prod) or die("Eroare preluare produse din cos!");
					$j = 0;
					$total=0;
                    $edit_cosuri .= "
                    <div id='editeaza_cos_".$rs_cos[7]."' class='detalii' style='margin-top:-600px; z-index:999; display:none; padding:10px;' align=center>
                        <form method='post' target='modif_cos' action='salvez_modif_cos.php' id='form_cos_".$rs_cos[7]."' name='form_cos_".$rs_cos[7]."'>
                            <input type='hidden' id='idcos' name='idcos' value=".$rs_cos[7].">
                            <table cellpadding=3 cellspacing=0 border=0 style='color: #000; border-collapse: collapse;'>
                            <tr>
                                <td colspan=4 align=right><p valign=middle onmouseover=\"this.style.cursor='pointer'\" onclick=\"document.getElementById('editeaza_cos_".$rs_cos[7]."').style.display='none';\"><img title='Inchide fereastra' border=0 src='../ico/exit.png'></p></td>
                            </tr>                                                                                    
                                ";
					while ($rs_prod = mysql_fetch_array($q_prod))
					{
						if ( $rs_prod[2] > 0 )
				        {
				            $pret = round($rs_prod[1]*((100-$rs_prod[2])/100),2);
				        }
				        else
				        {
				            $pret = $rs_prod[1];
				        }
				        if ($j>0)
				        	echo "<tr ".$class.">";
						echo "
						<td>".$rs_prod[0]."</td>
						<td align=center>".$cant_arr[$j]."</td>
						<td align=right>".$pret."</td>
						<td align=right>".$masuri_arr[$j]."</td>
						<td align=right>".round($cant_arr[$j]*$pret,2)."</td>
						</tr>
						";
                        $edit_cosuri .= "
                        <tr>
                            <td>".$rs_prod[0]."</td>
                            <td align=center> <span style='font-size:24px;' title='Scad cantitatea' onmouseover=\"this.style.cursor='pointer'\" onclick='min_cant(".$rs_cos[7].",".$j.",".$pret.");'><b>-</b></span> <input size=4 type='text' class='input' id='cant_".$rs_cos[7]."_".$j."' name='cant_".$rs_cos[7]."_".$j."' value='".$cant_arr[$j]."'> <span style='font-size:24px;' title='Cresc cantitatea' onmouseover=\"this.style.cursor='pointer'\" onclick='add_cant(".$rs_cos[7].",".$j.",".$pret.");'><b>+</b></span> </td>
                            <td align=right><input size=6 type='text' class='input' id='pretu_".$rs_cos[7]."_".$j."' name='pretu_".$rs_cos[7]."_".$j."' value='".$pret."' disabled></td>
                            <td align=right><input size=6 type='text' class='input' id='val_".$rs_cos[7]."_".$j."' name='val_".$rs_cos[7]."_".$j."' value='".round($cant_arr[$j]*$pret,2)."' disabled></td>
                        </tr>
                        ";
                        
						$total += round($cant_arr[$j]*$pret,2);
						$j++;
					}
                    // -------------- curierat -------------
					/*
                    if ( $rs_cos[16] == 0 )
                    {
                        $curier = "Taxe curierat - Posta romana";
                        $pret_curier = 12;
                        $sel_curier = "
                        <select id='tr_".$rs_cos[7]."' name='tr_".$rs_cos[7]."' class='input' onchange='ch_tr(".$rs_cos[7].", this, $total)'>
                          <option value=0 selected>Posta Romana: 12 lei ( 2-5 zile )</option>
                          <option value=1>Cargus: 25 lei ( 72 ore )</option>
                        </select>
                        ";   
                    }
                    if ( $rs_cos[16] == 1 )
                    {
                        $curier = "Taxe curierat - Cargus";
                        $pret_curier = 25;
                        $sel_curier = "
                        <select id='tr_".$rs_cos[7]."' name='tr_".$rs_cos[7]."' class='input' onchange='ch_tr(".$rs_cos[7].", this, $total)'>
                          <option value=0>Posta Romana: 12 lei ( 2-5 zile )</option>
                          <option value=1 selected>Cargus: 25 lei ( 72 ore )</option>
                        </select>
                        ";
                    }
                    echo "
                        <tr ".$class.">
                        <td>".$curier."</td>
                        <td align=center>1</td>
                        <td align=right>".$pret_curier."</td>
                        <td align=right>".round($pret_curier,2)."</td>
                        </tr>
                    ";
                    $edit_cosuri .= "
                        <tr>
                            <td> Transport : 
                            ".$sel_curier."
                            </td>
                            <td align=center><input type='text' class='input' id='cant_".$rs_cos[7]."_tr' name='cant_".$rs_cos[7]."_tr' value='1' size=4 disabled></td>
                            <td align=right><input type='text' class='input' id='pretu_".$rs_cos[7]."_tr' name='pretu_".$rs_cos[7]."_tr' value='".$pret_curier."' disabled size=6></td>
                            <td align=right><input type='text' class='input' id='val_".$rs_cos[7]."_tr' name='val_".$rs_cos[7]."_tr' value='".round($pret_curier,2)."' disabled size=6></td>
                        </tr>
                        ";
                    $total += round($pret_curier,2);
					 */
                    // -------------- curierat -------------
                    $edit_cosuri .= "</tr>
                    <tr>
                        <td colspan=3 align=center valign='middle'><h3>T O T A L</h3></td>
                        <td id='total_tabel_".$rs_cos[7]."' align='right' valign='middle'><h3>".$total."</h3></td>
                    </tr>
                    <tr>
                        <td colspan=4 align=center>
                            <input type='hidden' id='linii' name='linii' value='".$j."'>
                            <input type='button' class='submit' value='Salveaza modificarile' onclick=\"document.getElementById('form_cos_".$rs_cos[7]."').submit(); document.getElementById('editeaza_cos_".$rs_cos[7]."').style.display='none';\">
                        </td>
                    </tr>
                    ";
                    $edit_cosuri .= "</table>";
                    $edit_cosuri .= "
                                    </form>";
                    $edit_cosuri .= "</div>";
					echo "<tr><td colspan=8 align=center style='border-top:1px solid #CCC; font-size:15px; color: #900; font-weight:bold;'>TOTAL</td><td align=right style='border-top:1px solid #CCC; font-size:15px; color: #900; font-weight:bold;'>".$total."</td></tr>";
                    $linie++;
					$detalii_cosuri .= "
					<div id='detalii_cos_".$rs_cos[7]."' class='detalii' style='margin-top:-600px; z-index:999; display:none; padding:10px;' align=center>
						<table cellpadding=5 cellspacing=0 border=0 style='color: #000; border-collapse: collapse;'>
							<tr>
								<td colspan=2 align=right><p valign=middle onmouseover=\"this.style.cursor='pointer'\" onclick=\"document.getElementById('detalii_cos_".$rs_cos[7]."').style.display='none';\"><img title='Inchide fereastra' border=0 src='../ico/exit.png'></p></td>
							</tr>
							<tr>
								<td>Judet: </td>
								<td>".$rs_cos[8]."</td>
							</tr>
							<tr>
								<td>Localitate: </td>
								<td>".$rs_cos[9]."</td>
							</tr>
							<tr>
								<td>Adresa: </td>
								<td>".$rs_cos[10]."</td>
							</tr>
							<tr>
								<td>Cod postal: </td>
								<td>".$rs_cos[11]."</td>
							</tr>
							<tr>
								<td>Telefon: </td>
								<td>".$rs_cos[12]."</td>
							</tr>
							<tr>
								<td>Email: </td>
								<td>".$rs_cos[13]."</td>
							</tr>
							<tr>
								<td>Telefon mobil: </td>
								<td>".$rs_cos[14]."</td>
							</tr>
							<tr>
								<td>Fax: </td>
								<td>".$rs_cos[15]."</td>
							</tr>
						</table><br>
						<center><input type='button' class='submit' value='Valideaza' onclick=\"document.getElementById('valideaza_cos').src='validez_cos.php?email=".$rs_cos[13]."&idcos=".$rs_cos[7]."';\"></center>
					</div>
					";
					
					$gr_total += $total;
				}
				echo "<tr><td colspan=8 align=center style='border-top:2px solid #CCC; font-size:14pt; color: #900;'>TOTAL</td><td align=right style='border-top:2px solid #CCC; font-size:14pt; color: #900; background: url(../images/bg_header_galben.png);background-position:bottom;'>".$gr_total."</td></tr>";
			}
			else
			{
				echo "<tr><td colspan=8>In acest moment nu sunt cosuri pentru validare !</td></tr>";
			}
			echo "</table>";
			?>
		</table>
        <iframe id="modif_cos" name="modif_cos" marginheight="0" marginwidth="0" frameborder="0" width="0" height="0" src="" scrolling="no"></iframe>
		<iframe id="valideaza_cos" name="valideaza_cos" marginheight="0" marginwidth="0" frameborder="0" width="0" height="0" src="" scrolling="no"></iframe>
		<?
		echo $detalii_cosuri;
		 echo $edit_cosuri;
		?>
	<script type="text/javascript">
		jQuery("#main_frame",window.parent.document).load(function(){
			var db1 = jQuery(document).height();
			var docHeight = db1;
			jQuery("#main_frame",window.parent.document).height(docHeight +50);
			jQuery("#body",window.parent.document).height(docHeight +60);
		})
	</script>
</body>
</html>
<?
}
?>
