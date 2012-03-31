<?
session_start() ;
if ( isset($_SESSION["auth"]) && $_SESSION["auth"] == "da" && ( $_SESSION["tipusr"] == 1 || $_SESSION["tipusr"] == 2 ) )
{
include("../inc/global.php");
$db = "";
switch ( $_REQUEST["db"] )
{
case "cat":
    $db = "categorii";
    mysql_query("UPDATE ".$db." SET denumire = '".$_REQUEST["val"]."' WHERE id = ".$_REQUEST["id"]);
    break;
case "subcat":
    $db = "subcategorii";
    mysql_query("UPDATE ".$db." SET denumire = '".$_REQUEST["val"]."', id_categ = ".$_REQUEST["id_cat"]." WHERE id = ".$_REQUEST["id"]);
    break;
case "pr":
    $db = "producatori";
    if ( isset($_REQUEST["den"]) && $_REQUEST["den"] != null && $_REQUEST["den"] != "" ) 
    {
    	mysql_query("UPDATE ".$db." SET denumire = '".$_REQUEST["den"]."' WHERE id = ".$_REQUEST["id"]);
	}
    if ( isset($_REQUEST["link"]) && $_REQUEST["link"] != null && $_REQUEST["link"] != "" ) 
    {
    	mysql_query("UPDATE ".$db." SET link = '".$_REQUEST["link"]."' WHERE id = ".$_REQUEST["id"]);
	}
	$sigla = $_REQUEST["fis"];
    if ( $_FILES[$sigla]["error"] == 0)
    {
    	$mesaj = "";
		if ( (($_FILES[$sigla]["type"] == "image/gif") || ($_FILES[$sigla]["type"] == "image/jpeg") || ($_FILES[$sigla]["type"] == "image/png")))
		{
			$target_path = "../images/producatori/";
			$ext=substr(basename( $_FILES[$sigla]['name']),(strlen(basename( $_FILES[$sigla]['name']))-4));
			$fara_ext = $target_path.$_REQUEST["id"];
			$target_path .= $_REQUEST["id"].$ext;
			
			if (file_exists($target_path.".jpg") )
			{
				unlink($fara_ext.'.jpg');
			}
			if (file_exists($target_path.".gif") )
			{
				unlink($fara_ext.'.gif');
			}
			if (file_exists($target_path.".png") )
			{
				unlink($fara_ext.'.png');
			}
			if(move_uploaded_file($_FILES[$sigla]['tmp_name'], $target_path)) {
				$mesaj = "Sigla producatorului a fost uploadata cu succes.";
			} else{
				$mesaj = "A aparut o eroare la uploadarea fisierului ce contine sigla producatorului!";
			}
		}
		else
		{
			$mesaj = "Fisierul nu indeplineste conditiile pentru upload!";
		}
		if ( $mesaj == "Sigla producatorului a fost uploadata cu succes.")
		{
			echo "
			<script>
				parent.document.getElementById('poza_".$_REQUEST["id"]."').innerHTML=\"<img src='../images/producatori/".$_REQUEST["id"].$ext."' border=0 height=40px width=40px >\";
				//top.document.getElementById('main_frame').src='ro/mod_producatori.php';
			</script>
			";
		}
		echo "
		<script>
			alert ('".$mesaj."');
		</script>";
    }
    break;
case "prod":
    $db = "produse";
	$masuri =array();
	if (isset($_REQUEST['masuri_tip1'])) $masuri = $_REQUEST['masuri_tip1'];
    if (isset($_REQUEST['masuri_tip2'])) $masuri = $_REQUEST['masuri_tip2'];
    if (isset($_REQUEST['masuri_tip3'])) $masuri = $_REQUEST['masuri_tip3'];
    $sql = "UPDATE ".$db." SET ";
    $sql .= " nume = '".$_REQUEST["nume"]."', ";
    $sql .= " cod = '".$_REQUEST["cod"]."', ";
    $sql .= " descriere = '".str_replace("<br>","\r\n",$_REQUEST["descriere"])."', ";
    $sql .= " id_categorie = ".$_REQUEST["categorie"].", ";
    $sql .= " indicatii = '".str_replace("<br>","\r\n",$_REQUEST["indicatii"])."', ";
    $sql .= " pret = ".$_REQUEST["pret"].", ";
    $sql .= " id_producator = ".$_REQUEST["producator"].", ";
    $sql .= " id_subcategorie = ".$_REQUEST["subcategorie"].", ";
    $sql .= " reducere = ".$_REQUEST["reducere"].", "; 
    $sql .= " prima_pagina = '".$_REQUEST["prima_pagina"]."', ";
    $sql .= " super_oferta = '".$_REQUEST["super_oferta"]."', ";
    $sql .= " prod_la_comanda = ".$_REQUEST["prod_la_comanda"].", ";
    $sql .= " grila_masuri = '".implode(",",$masuri)."' ";
    $sql .= " WHERE id = ".$_REQUEST["id"]." ";
    mysql_query($sql) or die("<script>alert(\"Eroare la actualizare produs.\");</script>");
	$mesaj = "";
	$ext_arr = array(".png",".jpg",".gif");
	if (isset($_FILES["poza"]) && $_FILES["poza"]["error"] == 0)
	{
		if ( (($_FILES["poza"]["type"] == "image/png" || $_FILES["poza"]["type"] == "image/gif") || ($_FILES["poza"]["type"] == "image/jpeg") ) && ($_FILES["poza"]["size"] < 50000) )
		{
			$lastid = $_REQUEST["id"];
			$target_path = "../images/produse/mari/";
			$target_path_thumb = "../images/produse/";
			$ext=substr(basename( $_FILES['poza']['name']),(strlen(basename( $_FILES['poza']['name']))-4));
			$target_path .= $lastid.$ext;
			$target_path_thumb .= $lastid.$ext;
			
			foreach ($ext_arr as $key=>$value) 
			{
				if (file_exists($target_path) )
				{
					unlink($target_path);
				}
				if (file_exists($target_path_thumb) )
				{
					unlink($target_path_thumb);
				}
			}
			if(move_uploaded_file($_FILES['poza']['tmp_name'], $target_path))
			{
				include_once "../inc/create_thumb.php";
				$thumb = make_thumb($target_path, $target_path_thumb, WIDTH, HEIGHT);
				if($thumb)
				{
					$mesaj = "Poza produsului a fost uploadata cu succes.";
				}
			}
			else
			{
				$mesaj = "A aparut o eroare la uploadarea fisierului ce contine poza produsului!";
			}
		}
		else
		{
			$mesaj = "Fisierul nu indeplineste conditiile pentru upload!";
		}
	}
    echo "
    <script>
        alert ('Modificarea produsului a fost efectuata cu succes!\\n".$mesaj."');
    </script>";
    break;
}
echo "
<script>
    parent.document.getElementById('efect_op_".$_REQUEST["id"]."').innerHTML = \"<img src='../ico/ok.png' border=0>\";
</script>
" ;
}
?>