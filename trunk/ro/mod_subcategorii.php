<?
session_start();
include("../inc/global.php");
if ( isset($_SESSION["auth"]) && $_SESSION["auth"] == "da" && ( $_SESSION["tipusr"] == 1 || $_SESSION["tipusr"] == 2 ) )
{
?>
<html>
    <head>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
        <title>Modificare subcategorii</title>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="author" content="Bajanica Bogdan Dionisie">
        <meta name="description" content="Medical Active - modificare subcategorie">
        <meta name="copyright" content="&copy; 2009 Medical Active SRL" />
        <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
    </head>
    <body>
    <div class="titlu_pag">Modificare subcategorie</div>
        <form target="_self" method="post" id="form_cat" name="form_cat">
            <table cellpadding="2" cellspacing="0" border="0" style="white-space:nowrap;">
                <tr>
                    <th>Denumire subcategorie</th>
                    <th width="60">Operatiuni</th>
                    <th>&nbsp;</th>
                </tr>
                <?
                $str_categ = "SELECT id, denumire, id_categ FROM subcategorii ORDER BY denumire";
                $q_categ = mysql_query($str_categ) or die("Eroare preluare subcategorie!");
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
                <tr class="<?=$class?>" >
                    <td style="border-bottom:1px solid #000;">
                        <input class="edit" type="text" readonly="readonly" name="denumire_<?=$rs[0]?>" id="denumire_<?=$rs[0]?>" value="<?=$rs[1]?>" />
                        <br/>
                        <select disabled="disabled" class="edit" id="id_cat_<?=$rs[0]?>" name="id_cat_<?=$rs[0]?>" >
                            <option value="0">- ALEGE -</option>
                            <?
                            $str_cat = "SELECT id, denumire FROM categorii ORDER BY denumire";
                            $q_cat = mysql_query($str_cat) or die("Eroare aparuta la preluarea categoriilor de produse!");
                            while ( $rs_cat = mysql_fetch_array($q_cat) )
                            {
                                if ($rs[2] == $rs_cat[0] )
                                    echo "<option selected value='".$rs_cat[0]."'>".$rs_cat[1]."</option>\n";
                                else
                                    echo "<option value='".$rs_cat[0]."'>".$rs_cat[1]."</option>\n";
                            }
                            ?>
                        </select>
                    </td>
                    <td align="center" style="border-bottom:1px solid #000;">
                        <img onmouseover="this.style.cursor='pointer';" title="Editare" src="../ico/edit.png" border=0 onclick="document.getElementById('save_<?=$rs[0]?>').style.visibility='visible';document.getElementById('id_cat_<?=$rs[0]?>').removeAttribute('disabled');document.getElementById('denumire_<?=$rs[0]?>').removeAttribute('readOnly');document.getElementById('id_cat_<?=$rs[0]?>').className='edit_over'; document.getElementById('denumire_<?=$rs[0]?>').className='edit_over';">
                        <img onmouseover="this.style.cursor='pointer';" title="Stergere" src="../ico/delete.png" border=0 onclick="if ( confirm('Esti sigur ca doresti stergerea acestei subcategorii?') ) {document.getElementById('frm').src='sterg.php?db=subcat&id=<?=$rs[0]?>'}">
                        <img id='save_<?=$rs[0]?>' name="save_<?=$rs[0]?>" style="visibility:hidden;" onmouseover="this.style.cursor='pointer';" title="Salvare modificari" src="../ico/save.png" border="0" onclick="this.style.visibility='hidden';document.getElementById('denumire_<?=$rs[0]?>').className='edit';document.getElementById('denumire_<?=$rs[0]?>').setAttribute('readonly','readonly');document.getElementById('id_cat_<?=$rs[0]?>').setAttribute('disabled','disabled');document.getElementById('id_cat_<?=$rs[0]?>').className='edit';document.getElementById('frm').src='edit.php?db=subcat&id=<?=$rs[0]?>&val='+document.getElementById('denumire_<?=$rs[0]?>').value+'&id_cat='+document.getElementById('id_cat_<?=$rs[0]?>').value;">
                    </td>
                    <td id="efect_op_<?=$rs[0]?>" name="efect_op_<?=$rs[0]?>" style="border-bottom:1px solid #000;">
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