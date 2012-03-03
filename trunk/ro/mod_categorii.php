<?
session_start();
include("../inc/global.php");
if ( isset($_SESSION["auth"]) && $_SESSION["auth"] == "da" && ( $_SESSION["tipusr"] == 1 || $_SESSION["tipusr"] == 2 ) )
{
?>
<html>
    <head>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
        <title>Modificare categorii de produse</title>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="author" content="Bajanica Bogdan Dionisie">
        <meta name="description" content="Ortoprotetica - modificare categorii de produse">
        <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
        <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
		<script type="text/javascript">
			$(window).load(function(){
				$("#main_frame",window.parent.document).height($(document).height());
			});    
		</script>
    </head>
    <body>
    <div class="titlu_pag">Modificare categorii de produse</div>
        <form target="_self" method="post" id="form_cat" name="form_cat">
            <table cellpadding="2" cellspacing="0" border="0" style="white-space:nowrap;">
                <tr>
                    <th>Denumire categorie</th>
                    <th width="60">Operatiuni</th>
                    <th>&nbsp;</th>
                </tr>
                <?
                $str_categ = "SELECT id, denumire FROM categorii ORDER BY denumire";
                $q_categ = mysql_query($str_categ) or die("Eroare preluare categorii!");
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
                    <td><input onblur="this.className='edit';this.setAttribute('readonly','readonly');document.getElementById('frm').src='edit.php?db=cat&id=<?=$rs[0]?>&val='+this.value;" class="edit" type="text" readonly="readonly" name="denumire_<?=$rs[0]?>" id="denumire_<?=$rs[0]?>" value="<?=$rs[1]?>" /></td>
                    <td align="center">
                        <img onmouseover="this.style.cursor='pointer';" title="Editare" src="../ico/edit.png" border=0 onclick="document.getElementById('denumire_<?=$rs[0]?>').removeAttribute('readOnly'); document.getElementById('denumire_<?=$rs[0]?>').className='edit_over';document.getElementById('denumire_<?=$rs[0]?>').focus();">
                        <img onmouseover="this.style.cursor='pointer';" title="Stergere" src="../ico/delete.png" border=0 onclick="if ( confirm('Esti sigur ca doresti stergerea acestei categorii de produse?') ) {document.getElementById('frm').src='sterg.php?db=cat&id=<?=$rs[0]?>'}">
                    </td>
                    <td id="efect_op_<?=$rs[0]?>" name="efect_op_<?=$rs[0]?>">
                        &nbsp;
                    </td>
                </tr>
                <?
                    $linie++;
                }
                ?>
                <tr>
                    <td colspan="2" align="center">
                        <iframe id="frm" width="0" height="0" name="frm" src="" frameborder="0" marginheight="0" marginwidth="0" scrolling="no" />
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
<?
}
?>