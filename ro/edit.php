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
    if ( isset($_REQUEST["val"]) && $_REQUEST["val"] != null && $_REQUEST["val"] != "" ) 
    {
    	mysql_query("UPDATE ".$db." SET denumire = '".$_REQUEST["val"]."' WHERE id = ".$_REQUEST["id"]);
	}
    if ( isset($_REQUEST["fis"]) && $_REQUEST["fis"] != "")
    {
    	$sigla = $_REQUEST["fis"];
    	$mesaj = "";
		if ( (($_FILES[$sigla]["type"] == "image/gif") || ($_FILES[$sigla]["type"] == "image/jpeg") ) && ($_FILES[$sigla]["error"] == 0) )
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
				parent.document.getElementById('poza_".$_REQUEST["id"]."').innerHTML=\"<img src='../images/producatori/".$_REQUEST["id"].$ext."' border=0 height=40px width=40px class='corner iradius10 ishadow25'>\";
                top.document.getElementById('main_frame').src='ro/mod_producator.php';
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
    $sql = "UPDATE ".$db." SET ";
    $sql .= " nume = '".$_REQUEST["nume"]."', ";
    $sql .= " descriere = '".$_REQUEST["descriere"]."', ";
    $sql .= " id_categorie = ".$_REQUEST["categorie"].", ";
    $sql .= " indicatii = '".$_REQUEST["indicatii"]."', ";
    $sql .= " pret = ".$_REQUEST["pret"].", ";
    $sql .= " id_producator = ".$_REQUEST["producator"].", ";
    $sql .= " id_subcategorie = '".$_REQUEST["subcategorie"]."', ";
    $sql .= " reducere = ".$_REQUEST["reducere"].", "; 
    $sql .= " prima_pagina = '".$_REQUEST["prima_pagina"]."', ";
    $sql .= " super_oferta = '".$_REQUEST["super_oferta"]."' ";
    $sql .= " WHERE id = ".$_REQUEST["id_produs"] ;
    mysql_query($sql) or die("<script>alert('Eroare la actualizare date produs.<br>');</script>");
    echo "
    <script>
        alert ('Modificarea produsului a fost efectuata cu succes!');
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