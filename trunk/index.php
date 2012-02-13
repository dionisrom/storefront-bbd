<?php
session_start();
include("inc/global.php"); 
if ( !isset($_SESSION["merge"]) || $_SESSION["merge"] != 1 )
{
    session_unregister("user");
    session_unregister("id_user");
    session_unregister("nume");
    session_unregister("mesaj_auth");
    session_unregister("id");
    session_unregister("auth");
    session_unregister("tipusr");
    session_unregister("merge");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Test</title>
        <?php
            include_once("inc/BBDWebSite.php");
            $myPage = new BBDWebSite();
            if (isset($_SESSION["tipusr"]) && $_SESSION["tipusr"] <= 2)
            {
				$myPage->body_left = false;
				$pag = "";
            }
            else
            {
				$pag = "ro/acasa.php";
            }
            $myPage->setWidth();
            $myPage->setLogo("img/logo.png");
            echo $myPage->setHeaderInclude();
            echo $myPage->setCSS();
        ?>
        <style>
        	html, body, body center
        	{
				background-color: lightgray;
        	}
        </style>
        <script>
        function ResizeIframe()
        {
            elem="main_frame";
            var h = (document.getElementById(elem).contentDocument.body.scrollHeight);
            jQuery("#"+elem).height(h + 30);
            //setTimeOut($(this).contents().find('body').width($('.body').width()-20),2000);
        }
        </script>
    </head>
    <body>
        <center>
        <?php
            if (isset($_SESSION["tipusr"]) && $_SESSION["tipusr"] <= 2)
            {
			    $head_content = '';
            }
            else
            {
			    $head_content = "
			    <!--Header Start-->
			    <div style='float: right; margin-right: 20px;'>
				    <form id='cautare' name='cautare' method='post' action='ro/cauta.php' >
					    <table cellpadding='0' cellspacing='0' border='0'>
						    <tr>
							    <td title='Cauta' onmouseover=\"this.style.cursor='pointer';\" onclick=\"document.getElementById('cautare').submit();\">
								    <img src='images/search.png' border=0><b>Cauta</b>:&nbsp;
							    </td>
							    <td>
								    <input type='text' class='input' size='40' id='caut' name='caut'>
							    </td>
						    </tr>
					    </table>
				    </form>
			    </div>
			    ";
            }
            $myPage->setHeaderContent($head_content);
			if ( !isset($_SESSION["tipusr"]) || $_SESSION["tipusr"] > 2 )
				$arr_menu = array("Acasa","Despre noi","Cum cumpar","Cum platesc","Livrare","Asistenta","Parteneri","Contact");
			else
				$arr_menu = array("Introducere"=>array("Producator", "Categorie", "Subcategorie", "Produs"),"Modificare"=>array("Producator", "Categorie", "Subcategorie", "Produs"),"Administrare cosuri","Administrare useri","Rapoarte","Pagini web");
            $myPage->setMenu($arr_menu);
            //$myPage->setLogo();
			
			//--IFRAME Start--
			
			if ( isset($_REQUEST["validare"]) && $_REQUEST["validare"] == 1 ) 
			{
				$pag = "validare.php?username=".$_REQUEST["username"]."&cod=".$_REQUEST["cod_validare"];
			}
			
			$body_content = '
				<iframe name="main_frame" id="main_frame" allowtransparency="true" onload="ResizeIframe();" style="width: 100%; height:100%;" frameborder="no" marginwidth="0" marginheight="0" src="'.$pag.'" scrolling="auto"></iframe>
			';
			//-- IFRAME End--
			
            // -- Setez partea din stanga a body-ului START --
            $myPage->body_left_content = "";
            $categories_list = "";
            $str_cat = "SELECT denumire,id FROM categorii ORDER BY denumire";
            $q_cat = mysql_query($str_cat) or die("Eroare aparuta la preluarea categoriilor de produse!");
            while ( $rs_cat = mysql_fetch_array($q_cat) )
            {
                $categories_list .= "<li onclick=\"document.getElementById('main_frame').src='ro/produse.php?mod=2&id_catprod=".$rs_cat[1]."'\">".$rs_cat[0]."</li>";
            }
            $produse_categorii = "
            <div class='left_produse'>
                <div class='header_produse'></div>
                <div class='caseta_content'>
                    <ul>
                        ".$categories_list."
                    </ul>
                </div>
                <div class='caseta_bottom'></div>
            </div>
            ";
            $myPage->body_left_content .= $produse_categorii;
            // -- Setez partea din stanga a body-ului STOP --
            
            // Afisez caseta de cos - STOP
            $myPage->body_right_content .= '
            <div id="cos_div">
                <iframe name="cos_frame" id="cos_frame" width=0 height=0 frameborder=no src="" style="display: hidden;"></iframe>
                <div class="cos_div_header"></div>
                <div id="continut_cos" align="center">
            ';
            if ( !isset($_SESSION["cos"]) || ( isset($_SESSION["cos"]) && $_SESSION["cos"] != "plin") )
            {
                $myPage->body_right_content .= "<br \>Cosul este gol!<br \><br \>";
            }
            else
            {
                $myPage->body_right_content .= "<script>document.getElementById('cos_frame').src='cos.php';</script>";
            }
            $myPage->body_right_content .= '
                </div>
                <div class="cos_div_footer">
                    <input type="button" class="submit" value="Vezi cos" onclick="document.getElementById(\'main_frame\').src=\'ro/cos_det.php\';">
                    <br />
                    <input type="button" class="submit" value="Goleste cos" onclick="document.getElementById(\'cos_frame\').src=\'cos.php?reset_cos=1\';">
                </div>
                <!--
                <p align=center>
                    <input type="button" class="submit" value="Vezi cos" onclick="document.getElementById(\'main_frame\').src=\'ro/cos_det.php\';">
                    <input type="button" class="submit" value="Goleste cos" onclick="document.getElementById(\'cos_frame\').src=\'cos.php?reset_cos=1\';">
                </p>
                -->
            </div>    
            ';
            // Afisez caseta de cos - STOP
            
            // Afisez caseta de login - START
			if ( isset($_SESSION["auth"]) && $_SESSION["auth"] == "da" && isset($_SESSION["err"]) && $_SESSION["err"] == "fara" )
			{	
				$myPage->body_right_content .= '
				<div id="login_div">
						'.$_SESSION["mesaj_auth"].'
						<br />
						<form method="post" action="logout.php" target="_self" style="margin-top:5px;">
								<a class="login" href="javascript:;" onclick="document.getElementById(\'main_frame\').src=\'modif_cont.php\';">&nbsp;Modificare detalii cont&nbsp;</a>
								<br />
								<input class="submit" style="margin-top:20px;" title="Deconectare utilizator" type="submit" value="Deconectati-va" style="margin-bottom:5px" onmouseover="this.style.cursor=\'pointer\';">
						</form>
				</div>
				';
			}
			if ( !isset($_SESSION["err"]) || $_SESSION["err"] != "fara" || !isset($_SESSION["auth"]) || $_SESSION["auth"] != "da" )
			{
				$myPage->body_right_content .= '
				<div id="login_div">
					<form id="auth_usr" name="auth_usr" method="post" action="auth.php" target="_self">
						<input type="text" value="utilizator" class="input" id="usrid" name="usrid" style="margin-top: 48px;" onblur="if(this.value==\'\') { this.value=\'utilizator\';}" onfocus="this.value=\'\';" />
						<input type="text" value="parola" class="input" id="passwd" name="passwd" onblur="if(this.value==\'\') {this.type=\'text\'; this.value=\'parola\';}" onfocus="this.value=\'\'; this.type=\'password\';" />
						<input type="hidden" id="sessid" name="sessid" value="'.session_id().'">
						<input onmouseover="this.style.cursor=\'pointer\';" class="login_button" title="Autentificare utilizator" onsubmit="document.getElementById(\'auth_usr\').submit();" type="submit" value="">
						<br />
						<div class="help">
							Nu ai cont ?&nbsp;<a class="login" href="javascript:;" onclick="document.getElementById(\'main_frame\').src=\'contnou.php\';" title="Creeaza cont nou">Creaza cont ...</a>
							<br />
							Ajutor !&nbsp;<a class="login" href="javascript:;" onclick="document.getElementById(\'main_frame\').src=\'resetpass.php\';" title="Am uitat parola">Am uitat parola ...</a>
						</div>
					</form>
				</div>
				';
			}
			// Afisez caseta de login - STOP
			if ( isset($_SESSION["auth"]) && $_SESSION["auth"] == "da" && $_SESSION["err"] == "fara" )
			{
				$myPage->body_right_content .= "<div align='center' title='Istoric cumparaturi' onmouseover=\"this.style.cursor='pointer';\" onclick=\"document.getElementById('main_frame').src='ro/istoric.php';\">Istoric cumparaturi</div>";
			}
            $myPage->setBodyContent($body_content);
            echo $myPage->newPage();
        ?>
        </center>
    </body>
</html>
