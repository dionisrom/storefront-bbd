<?php
session_start();
$cale = "../images/slider/";
$width_restrict = 596;
$height_restrict = 290;
$mesaj = "";
if(isset($_REQUEST["op"]) && $_REQUEST["op"] == 'repl')
{
	if($_REQUEST["op"] == 'repl')
	{
		$imagine = $_FILES["imagine"];
		list($width, $height, $type, $attr) = getimagesize($imagine['tmp_name']);
		if ( ($width == $width_restrict && $height == $height_restrict) && ($imagine["type"] == "image/jpeg") && ($imagine["size"] < 300000) && ($imagine["error"] == 0) )
		{
			if (file_exists($cale.$_REQUEST["img_name"]))
				unlink($cale.$_REQUEST["img_name"]);
			
			if(move_uploaded_file($imagine['tmp_name'], $cale.$_REQUEST["img_name"])) {
				$mesaj = "Noua imagine a fost uploadata cu succes.";
			} else{
				$mesaj = "A aparut o eroare la uploadarea fisierului!";
			}
		}
		else
		{
			$mesaj = "Fisierul nu indeplineste conditiile pentru upload!<br />";
			$mesaj .= "1. dimensiuni imagine: ".$width."x".$height."( ar trebui sa fie ".$width_restrict."x".$height_restrict." )<br />";
			$mesaj .= "2. dimensiune fisier: ".$imagine["size"]."( ar trebui sa fie <= 300000 bytes )<br />";
			$mesaj .= "3. tipul fisierului: ".$imagine["type"]." ( ar trebui sa fie 'image/jpeg' )<br />";
			$mesaj .= "4. eroare fisier: ".$imagine["error"]." ( ar trebui sa fie 0 )<br />";
		}
	}
}
if (isset($_REQUEST["op"]) && $_REQUEST["op"] == "del")
{
	if (file_exists($cale.$_REQUEST["img_name"]))
	{
		unlink($cale.$_REQUEST["img_name"]);
	}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Administrarea imaginilor pentru slider</title>
		<LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
		<script type="text/javascript">
			$(window).load(function(){
				$("#main_frame",window.parent.document).height($(document).height());
			});    
		</script>
		<style>
			.op
			{
				margin-left: 40px;
				margin-right: 20px;
				white-space: nowrap;
				float: left;
			}
			.op img:hover
			{
				cursor: pointer;
			}
			ul li
			{
				margin: 10px;
			}
		</style>
    </head>
    <body>
		<div class="titlu_pag">Administrarea imaginilor pentru slider</div>
		<h4 style="line-height: 18px;"><?=$mesaj?></h4>
		<?php
			if ($handle = opendir($cale)) 
			{
				//echo "Entries:\n";
				$imagini = array();
				/* This is the correct way to loop over the directory. */
				while (false !== ($entry = readdir($handle))) {
					if ($entry != "." && $entry != "..") $imagini[] = $entry;
				}
				closedir($handle);
			}
			//print_r($imagini);
			echo "<ul style='list-style-type: none; float: left;'>
				";
			foreach ($imagini as $imagine)
			{
				echo "	<li><img src='".$cale.$imagine."' style='float: left; width: 150px; margin-left: 20px;' border=1 alt='' />
							<div class='op'>
								<label><img onclick=\"document.getElementById('op').value = 'del'; document.getElementById('img_name').value = '".$imagine."'; if(confirm('Sunteti sigur ca doriti sa STERGETI imaginea aceasta?')) document.getElementById('frm_op_images').submit(); else return false; return false;\" id='del_".$imagine."' border=0 src='../img/image_delete.png' alt='' /> - Sterge imaginea</label><br />
								<label><img onclick=\"document.getElementById('layer_form').style.display='block' ; document.getElementById('op').value = 'repl'; document.getElementById('img_name').value = '".$imagine."';\" id='repl_".$imagine."' border=0 src='../img/image_replace.gif' alt='' /> - Inlocuieste imaginea</label>
							</div>
							<div style='clear: both;'></div>
						</li>
					";
			}
			echo "</ul>";
		?>
		<fieldset id="layer_form" style="float: left; border: 1px solid #CFCFCF; width: 350px; height: 200px; display: none;">
			<form id="frm_op_images" target="_self" method="post" enctype="multipart/form-data">
				<input type="hidden" id='op' name='op' value="">
				<input type="hidden" id='img_name' name='img_name' value="">
				<br />
				Imagine noua:
				<br />
				<br />
				<input type="file" name="imagine" id="imagine" value="" class="input"/>
				<input type="submit" value="Executa modificarea">
				<input type="button" value="Anuleaza modificarea" onclick="document.getElementById('frm_op_images').reset(); document.getElementById('layer_form').style.display='none';">
			</form>
		</fieldset>
		<br />
		<br />
		<br />
    </body>

</html>
