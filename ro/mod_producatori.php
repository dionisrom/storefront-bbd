<?
session_start();
include("../inc/global.php");
if ( isset($_SESSION["auth"]) && $_SESSION["auth"] == "da" && ( $_SESSION["tipusr"] == 1 || $_SESSION["tipusr"] == 2 ) )
{
?>
<html>
    <head>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
        <title>Modificare producator</title>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="author" content="Bajanica Bogdan Dionisie">
        <meta name="description" content="Ortoprotetica - modificare producator">
        <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
        <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
        <script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
        <base target="frm">
    </head>
    <body>
    <div class="titlu_pag">Modificare producator</div>
        <table cellpadding="2" cellspacing="0" border="0" style="white-space:nowrap;">
            <tr>
                <th>Denumire producator</th>
                <th>Link</th>
                <th>Foto</th>
                <th width="60">Operatiuni</th>
                <th>&nbsp;</th>
            </tr>
            <?
            $str_categ = "SELECT id, denumire, link FROM producatori ORDER BY denumire";
            $q_categ = mysql_query($str_categ) or die("Eroare preluare producatori!");
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
                <td>
                    <input onblur="jQuery('#frm_<?=$rs[0]?> [name=den]').val(this.value);" class="edit" type="text" readonly="readonly" name="denumire_<?=$rs[0]?>" id="denumire_<?=$rs[0]?>" value="<?=$rs["denumire"]?>" style="width:150px;"/>
                </td>
                <td>
                    <input onblur="jQuery('#frm_<?=$rs[0]?> [name=link]').val(this.value);" class="edit" type="text" readonly="readonly" name="link_<?=$rs[0]?>" id="link_<?=$rs[0]?>" value="<?=$rs["link"]?>" style="width:150px;"/>
                </td>
                <td id="poza_<?=$rs[0]?>">
                    <?
                    if ( file_exists("../images/producatori/".$rs[0].".jpg") )
                    {
                    	echo "<img border=0 src='../images/producatori/".$rs[0].".jpg' height=40px width=40px class='corner iradius10 ishadow25'>";
                    }
                    else
                    {
                    	if ( file_exists("../images/producatori/".$rs[0].".gif") )
                    	{
                    		echo "<img border=0 src='../images/producatori/".$rs[0].".gif' height=40px width=40px class='corner iradius10 ishadow25'>";
                    	}
                    }
                    $form_ = '
                    <form id="frm_'.$rs[0].'" name="frm_'.$rs[0].'" method="post" enctype="multipart/form-data" target="frm" action="edit.php">
                        <input type="file" name="sigla_'.$rs[0].'" id="sigla_'.$rs[0].'" value="" class="input">
                        <input type="hidden" id="den" name="den" value="">
                        <input type="hidden" id="link" name="link" value="">
                        <input type="hidden" id="db" name="db" value="pr">
                        <input type="hidden" id="id" name="id" value="'.$rs[0].'">
                        <input type="hidden" id="fis" name="fis" value="sigla_'.$rs[0].'">
                    ';
                    ?>
                </td>
                <td align="center">
                    <?=$form_?>
                    <img onmouseover="this.style.cursor='pointer';" title="Editare" src="../ico/edit.png" border=0 onclick="document.getElementById('save_<?=$rs[0]?>').style.visibility='visible';document.getElementById('denumire_<?=$rs[0]?>').removeAttribute('readOnly');document.getElementById('link_<?=$rs[0]?>').removeAttribute('readOnly'); document.getElementById('denumire_<?=$rs[0]?>').className='edit_over';document.getElementById('link_<?=$rs[0]?>').className='edit_over';document.getElementById('denumire_<?=$rs[0]?>').focus();">
                    <img onmouseover="this.style.cursor='pointer';" title="Stergere" src="../ico/delete.png" border=0 onclick="if ( confirm('Esti sigur ca doresti stergerea acestui producator?') ) {document.getElementById('frm').src='sterg.php?db=pr&id=<?=$rs[0]?>'}">
                    <img id='save_<?=$rs[0]?>' name="save_<?=$rs[0]?>" style="visibility:hidden;" onmouseover="this.style.cursor='pointer';" title="Salvare modificari" src="../ico/save.png" border="0" onclick="this.style.visibility='hidden'; document.getElementById('denumire_<?=$rs[0]?>').className='edit'; document.getElementById('denumire_<?=$rs[0]?>').setAttribute('readonly','readonly');document.getElementById('link_<?=$rs[0]?>').className='edit'; document.getElementById('link_<?=$rs[0]?>').setAttribute('readonly','readonly');document.getElementById('frm_<?=$rs[0]?>').submit();">
                    </form>
                </td>
                <td id="efect_op_<?=$rs[0]?>" name="efect_op_<?=$rs[0]?>" style="vertical-align:top;">
                    &nbsp;
                </td>
            </tr>
            <?
                $linie++;
            }
            ?>
            <tr>
                <td colspan="2" align="center">
                    <iframe id="frm" width="0" height="0" name="frm" src="" frameborder="0" marginheight="0" marginwidth="0" scrolling="auto" ></iframe>
                </td>
            </tr>
        </table>
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