<?
session_start() ;
if ( isset($_SESSION["auth"]) && $_SESSION["auth"] == "da" && ( $_SESSION["tipusr"] == 1 || $_SESSION["tipusr"] == 2 ) )
{
include("../inc/global.php");
$db = "";
$pag = "";
switch ( $_REQUEST["db"] )
{
case "cat":
    $db = "categorii";
    $pag = 'mod_categorii.php';
    $mesaj_del = 'Categoria de produse a fost stearsa';
    break;
case "subcat":
    $db = "subcategorii";
    $pag = 'mod_subcategorii.php';
    $mesaj_del = 'Subcategoria a fost stearsa';
    break;
case "pr":
    $db = "producatori";
    $pag = 'mod_producatori.php';
    $mesaj_del = 'Producatorul a fost sters';
    if ( file_exists("../images/producatori/".$_REQUEST["id"].".jpg") )
        unlink("../images/producatori/".$_REQUEST["id"].".jpg");
    if ( file_exists("../images/producatori/".$_REQUEST["id"].".gif") )
        unlink("../images/producatori/".$_REQUEST["id"].".gif");
    break;
case "prod":
    $db = "produse";
    $pag = 'mod_produs.php';
    $mesaj_del = 'Produsul a fost sters';
    if ( file_exists("../images/produse/".$_REQUEST["id"].".jpg") )
        unlink("../images/produse/".$_REQUEST["id"].".jpg");
    if ( file_exists("../images/produse/".$_REQUEST["id"].".gif") )
        unlink("../images/produse/".$_REQUEST["id"].".gif");
    break;    
}
mysql_query("DELETE FROM ".$db." WHERE id = ".$_REQUEST["id"]);
echo "
<script>
    alert('".$mesaj_del." cu succes !');
    parent.document.getElementById('frm').src='';
    parent.location.href='".$pag."';
</script>
" ;
}
?>