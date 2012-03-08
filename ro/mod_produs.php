<?
session_start();
include("../inc/global.php");
if ( isset($_SESSION["auth"]) && $_SESSION["auth"] == "da" && ( $_SESSION["tipusr"] == 1 || $_SESSION["tipusr"] == 2 ) )
{
?>
<html>
	<head>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<title>Modificare produs</title>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="author" content="Bajanica Bogdan Dionisie">
        <meta name="description" content="Ortoprotetica - Modificare produs">
        <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
        <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
        <!--[if IE]>
		<style>
		.trans
		{
			filter: alpha(opacity=95);
		}
		</style>
		<![endif]-->

		<!--[if !IE]>-->
		<style>
		.trans
		{
			-moz-opacity:0.95;
			opacity:.95;           
		}
		</style>
		<!--<![endif]-->
		<script>
			function getSubcateg(categ)
			{
				$.ajax({
					type : 'POST',
					url : 'getSubcategories.php',
					dataType : 'json',
					data: {
						categorie : categ
					},
					success : function(data){
						if (data.error === true)
							alert("Eroare ajax: "+data.msg);
						else
						{
							$("#subcategorie option[value!='0']").remove();
							$.each(data.opts, function(val, text) {
								$('#subcategorie').append( new Option(text,val) );
							});
						}
					}

				});
			};
		</script>
	</head>
	<body>
	<div class="titlu_pag">Modificare produs</div> 
		<?php
		$prod_in_pag = 20;
		$str_total_prod = "SELECT count(a.id) FROM produse a, producatori b, categorii c WHERE b.id = a.id_producator and c.id = a.id_categorie";
		$q_total_prod = mysql_query($str_total_prod) or die("<script>alert('Eroare preluare numar total de produse!');</script>");
		$rs_total_prod = mysql_fetch_array($q_total_prod);
		$total_pag = ceil(($rs_total_prod[0]) / $prod_in_pag);
		if (isset($_REQUEST["pag"]))
			$pag = $_REQUEST["pag"];
		else
			$pag = 1;

		$pag_nav = "
			<ul id='pag_nav' style='list-style-type: none;'>";
		for($i=1;$i<=$total_pag;$i++ )
		{
			if ($i == $pag)
			{
				$current = "background-color: #EAEAEA;";
				$class = " onmouseover=\"this.style.cursor='pointer'; this.style.backgroundColor='#EAEAEA';\" ";
			}
			else
			{
				$current = "";
				$class = " onmouseover=\"this.style.cursor='pointer'; this.style.backgroundColor='#EAEAEA';\" onmouseout=\"this.style.backgroundColor='transparent';\" ";
			}
			$pag_nav .= "
				<li style='padding: 3px; font-size:14px; float: left; ".$current."' ".$class." onclick=\"parent.document.getElementById('main_frame').src = './ro/mod_produs.php?pag=".$i."';\"><strong>".$i."</strong></li>";
		}
		$pag_nav .= "
			</ul>";
		echo $pag_nav."<br /><br />";
		?>
		<form target="_self" method="post" enctype="multipart/form-data" id="form_prod" name="form_prod">
			<table cellpadding="0" cellspacing="0" border="0" style="white-space:nowrap;">
	            <tr>
	                <th>Denumire produs</th>
	                <th>Cod produs</th>
	                <th>Categorie</th>
	                <th>Producator</th>
	                <th width="100">Operatiuni</th>
	                <th>&nbsp;</th>
	            </tr>
				<?
				$str_categ = "SELECT a.*, c.denumire as categ, b.denumire as producator FROM produse a, producatori b, categorii c WHERE b.id = a.id_producator and c.id = a.id_categorie ORDER BY a.nume LIMIT ".($pag-1)*$prod_in_pag.", ".($prod_in_pag);
				$q_categ = mysql_query($str_categ) or die("<script>alert('Eroare preluare produse!');</script>");
	            $linie = 0;
	            while ( $rs = mysql_fetch_array($q_categ) )
	            {
	                if ( $linie % 2 )
	                {
	                    $class = "odd";
	                }
	                else
	                {
	                    $class = "even";
	                }
	            ?>
				
                <tr class="<?=$class?>">
                	<td style="padding-left:4px; padding-right:4px;"><?=$rs["nume"]?></td>
                	<td style="border-left:1px solid #367766; padding-left:4px; padding-right:4px;"><?=$rs["cod"]?></td>
                	<td style="border-left:1px solid #367766; padding-left:4px; padding-right:4px;"><?=$rs["categ"]?></td>
                	<td style="border-left:1px solid #367766; padding-left:4px; padding-right:4px;"><?=$rs["producator"]?></td>
                	<td style="border-left:1px solid #367766; padding-left:4px; padding-right:4px;">
                		<img onmouseover="this.style.cursor='pointer';" title="Editare" src="../ico/edit.png" border=0 onclick="document.getElementById('product_box').style.visibility='visible'; document.getElementById('date_prod').src='date_produs.php?id=<?=$rs[0]?>'; ">
                        <img onmouseover="this.style.cursor='pointer';" title="Stergere" src="../ico/delete.png" border=0 onclick="if ( confirm('Esti sigur ca doresti stergerea acestui produs?') ) {document.getElementById('frm').src='sterg.php?db=prod&id=<?=$rs[0]?>'}">
                	</td>
                	<td id="efect_op_<?=$rs[0]?>" name="efect_op_<?=$rs[0]?>" style="padding-left:4px;padding-right:4px;" align="center">
                        &nbsp;
                    </td>
                </tr>
				<?
					$linie++;
				}
				?>
			</table>
		</form>
<div class="trans" id="product_box" style="position:absolute; top:100; left:150; visibility:hidden; background-color:#fa6c00;">
	<!-- NOTE: nested divs required for slide effect-->
	<div class="content_panel" id="content_box">
	    <form target="date_prod" action="edit.php" method="post" enctype="multipart/form-data" id="form_prod" name="form_prod">
            <table cellpadding="2" cellspacing="0" border="0" style="white-space:nowrap;" width="100%">
                <tr>
                    <td colspan="3" align="right" onclick="document.getElementById('product_box').style.visibility='hidden';" onmouseover="this.style.cursor='pointer';"  style="padding-right:20px;">Inchide</td>
                </tr>
                <tr>
                    <td>Denumire *:</td>
                    <td><input type="text" name="nume" id="nume" onkeyup="this.style.textTransform = 'capitalize';" value="" size="60" class="input" /></td>
                    <td id='err_nume' class="eroare_text"></td>
                </tr>
				<tr>
                    <td>Cod *:</td>
                    <td><input type="text" name="cod" id="cod" value="" size="30" class="input" /></td>
                    <td id='err_cod' class="eroare_text"></td>
                </tr>
                <tr>
                    <td>Descriere :</td>
                    <td><textarea name="descriere" id="descriere" cols="60" rows="3" class="input" ></textarea></td>
                    <td id='err_descriere' class="eroare_text"></td>
                </tr>
                <tr>
                    <td>Indicatii :</td>
                    <td><textarea name="indicatii" id="indicatii" cols="60" rows="3" class="input" ></textarea></td>
                    <td id='err_indicatii' class="eroare_text"></td>
                </tr>
                <tr>
                    <td>Poza produs :</td>
                    <td valign=""><img id="poza_existenta" src='' border="0" alt="" height="60" /> &nbsp;
                    <input type="file" name="poza" id="poza" value="" class="input" name="MAX_FILE_SIZE" value="50000"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Pret *:</td>
                    <td><input type="text" name="pret" id="pret" value="" size="30" class="input" /></td>
                    <td id='err_pret' class="eroare_text"></td>
                </tr>
                <tr>
                    <td>Categorie :</td>
                    <td>
                        <select name="categorie" id="categorie" class="input" onchange="getSubcateg($(this).val());">
                            <option>- ALEGE -</option>
                            <?
                            $str_cat = "SELECT id, denumire FROM categorii ORDER BY denumire";
                            $q_cat = mysql_query($str_cat) or die("Eroare aparuta la preluarea categoriilor!");
                            while ( $rs_cat = mysql_fetch_array($q_cat) )
                            {
                                echo "<option value='".$rs_cat[0]."'>".$rs_cat[1]."</option>\n";
                            }
                            ?>
                        </select>
                    </td>
                    <td id='err_categorie' class="eroare_text"></td>
                </tr>
                <tr>
                    <td>Subcategorie :</td>
                    <td>
                        <select name="subcategorie" id="subcategorie" class="input">
							<option value="0">- ALEGE -</option>
                        </select>
                    </td>
                    <td id='err_categorie' class="eroare_text"></td>
                </tr>
                <tr>
                    <td>Producator :</td>
                    <td>
                        <select name="producator" id="producator" class="input" >
                            <option value="0">- ALEGE -</option>
                            <?
                            $str_cat = "SELECT id, denumire FROM producatori ORDER BY denumire";
                            $q_cat = mysql_query($str_cat) or die("Eroare aparuta la preluarea producatorilor!");
                            while ( $rs_cat = mysql_fetch_array($q_cat) )
                            {
                                echo "<option value='".$rs_cat[0]."'>".$rs_cat[1]."</option>\n";
                            }
                            ?>
                        </select>
                    </td>
                    <td id='err_producator' class="eroare_text"></td>
                </tr>
                <tr>
                    <td>Apare pe prima pagina ?</td>
                    <td>
                        <select name="prima_pagina" id="prima_pagina" class="input" />
                            <option value="nu">NU</option>
                            <option value="da">DA</option>
                        </select>
                    </td>
                    <td id='err_prima_pagina' class="eroare_text"></td>
                </tr>
                <tr>
                    <td>Este o super oferta ?</td>
                    <td>
                        <select name="super_oferta" id="super_oferta" class="input" />
                            <option value="nu">NU</option>
                            <option value="da">DA</option>
                        </select>
                    </td>
                    <td id='err_super_oferta' class="eroare_text"></td>
                </tr>
                <tr>
                    <td>Reducere :</td>
                    <td><input type="text" name="reducere" id="reducere" value="0" size="30" class="input" /></td>
                    <td id='err_reducere' class="eroare_text"></td>
                </tr>
				<tr>
					<td>Se aduce doar la comanda :</td>
            		<td>
						<select name="prod_la_comanda" id="prod_la_comanda" class="input">
            				<option value="0">NU</option>
            				<option value="1">DA</option>
            			</select>
					</td>
            		<td id='err_prod_la_comanda' class="eroare_text"></td>
				</tr>
                <tr>
                    <td style="vertical-align: top;">Grila masuri:</td>
                    <td>
						<h3 style="margin-left: 15px;">Masuri tip 1</h3>
						<label style="width: 40px;"><input type="checkbox" name="masuri_tip1[]" id="S" value="S" class="input" /> S</label><br />
						<label style="width: 40px;"><input type="checkbox" name="masuri_tip1[]" id="M" value="M" class="input" /> M</label><br />
						<label style="width: 40px;"><input type="checkbox" name="masuri_tip1[]" id="L" value="L" class="input" /> L</label><br />
						<label style="width: 40px;"><input type="checkbox" name="masuri_tip1[]" id="XL" value="XL" class="input" /> XL</label><br />
						<label style="width: 40px;"><input type="checkbox" name="masuri_tip1[]" id="XXL" value="XXL" class="input" /> XXL</label><br />
						<hr>
						<h3 style="clear:both;margin-left: 15px;">Masuri tip 2</h3>
						<label>1 <input type="checkbox" name="masuri_tip2[]" value="1" id="1" class="input" /></label><br />
						<label>2 <input type="checkbox" name="masuri_tip2[]" value="2" id="2" class="input" /></label><br />
						<label>3 <input type="checkbox" name="masuri_tip2[]" value="3" id="3" class="input" /></label><br />
						<label>4 <input type="checkbox" name="masuri_tip2[]" value="4" id="4" class="input" /></label><br />
						<label>5 <input type="checkbox" name="masuri_tip2[]" value="5" id="5" class="input" /></label><br />
						<label>6 <input type="checkbox" name="masuri_tip2[]" value="6" id="6" class="input" /></label><br />
						<label>7 <input type="checkbox" name="masuri_tip2[]" value="7" id="7" class="input" /></label><br />
						<hr>
						<h3 style="margin-left: 15px;">Masuri tip 3</h3>
						<label>Masura unica <input type="checkbox" name="masuri_tip3[]" id="unica" value="unica" class="input" /></label><br />
					</td>
                    <td id='err_grila_masuri' class="eroare_text"></td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
                        <input type="hidden" id="id_produs" name="id_produs" value="">
                        <input type="hidden" id="id" name="id" value="">
                        <input type="hidden" id="db" name="db" value="prod">
                        <input type="submit" onclick="if (document.getElementById('nume').value==null || document.getElementById('nume').value=='' ) {document.getElementById('err_nume').innerHTML='Va rog introduceti numele produsului!';return false;} else {document.getElementById('form_prod').submit();document.getElementById('product_box').style.display='none';}" name="creaza_cont" id="creaza_cont" value="Modifica produs" class="submit" />
                    </td>
                </tr>
            </table>	
		</form>
	</div>
</div>

<iframe src="" id="date_prod" name="date_prod" frameborder="0" marginheight="0" marginwidth="0" height="0" width="0" scrolling="no"></iframe>
<iframe id="frm" width="0" height="0" name="frm" src="" frameborder="0" marginheight="0" marginwidth="0" scrolling="no"></iframe>

<script type="text/javascript">
	jQuery("#main_frame",window.parent.document).height(jQuery(document).height()+30);
</script>
</body>
</html>
<?
}
?>