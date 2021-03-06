<?php
session_start();
include_once("inc/global.php"); 
if ( !isset($_SESSION["merge"]) || $_SESSION["merge"] != 1 )
{
    unset($_SESSION["user"]);
    unset($_SESSION["id_user"]);
    unset($_SESSION["nume"]);
    unset($_SESSION["mesaj_auth"]);
    unset($_SESSION["id"]);
    unset($_SESSION["auth"]);
    unset($_SESSION["tipusr"]);
    unset($_SESSION["merge"]);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ro">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>ORTOPROTETICA</title>
        <?php
            include_once("inc/BBDWebSite.php");
            $myPage = new BBDWebSite();
            if (isset($_SESSION["tipusr"]) && $_SESSION["tipusr"] <= 2)
            {
				$myPage->body_left = false;
				//$myPage->leftWidth =1;
				$pag = "";
				//$myPage->setWidth(0,1,0);
				$css_file = "default_compiled_admin.css";
            }
            else
            {
				$myPage->body_left = true;
				$myPage->leftWidth = 206;
				$css_file = "default_compiled.css";
				$pag = "ro/acasa.php";
				$myPage->setWidth();
            }
            
            $myPage->setLogo("img/logo.png");
            echo $myPage->setHeaderInclude();
            echo $myPage->setCSS($css_file);
        ?>
    </head>
    <body style="background-color: #eceeef;">
		<div style="width:100%; height: 6px; background-color: #cbcdcf;"></div>
        <?php
            if (isset($_SESSION["tipusr"]) && $_SESSION["tipusr"] <= 2)
            {
			    $head_content = '';
            }
            else
            {
			    $head_content = "
			    <!--Header Start-->
				<div id='up_small_menu'>
					<div style='margin-right: 10px; float: right; font-size: 24px; color: #6897bd; white-space: nowrap;'>021 316 96 05</div>
					<div style='margin-right: 10px; width: 80%; float: right; font-size: 10px; text-align: right; white-space: nowrap; color: #7d7d7d;'>Pentru informatii<br />si comenzi telefonice</div>
					<div style=' padding: 0; margin: 0; width:99%; text-align: right; margin-right: 10px; float: right; font-weight: bold; white-space: nowrap; height: 15px;'>
						<ul>
							<li onclick=\"document.getElementById('main_frame').src='ro/acasa.php'\">Acasa</li>
							<li onclick=\"document.getElementById('main_frame').src='ro/ajutor_clienti.html'\">Ajutor Clienti</li>
							<li>Harta Site</li>
							<li onclick=\"document.getElementById('main_frame').src='ro/contact.html';\">Contact</li>
						</ul>
					</div>
				</div>
				<form id='cautare' name='cautare' method='post' action='ro/cauta.php' >
					<div class='search_div'>
						<div id='search_icon'></div>
						<input type='text' id='caut' name='caut'>
						<input type='button' id='btn_caut' onmouseover=\"this.style.cursor='pointer';\" onclick=\"document.getElementById('cautare').submit();\" />
					</div>
				</form>
				<!--Header Stop-->
			    ";
            }
            $myPage->setHeaderContent($head_content);
			if ( !isset($_SESSION["tipusr"]) || $_SESSION["tipusr"] > 2 )
				//$arr_menu = array("Acasa","Despre noi","Cum cumpar","Cum platesc","Livrare","Asistenta","Parteneri","Contact");
				$arr_menu = array("Acasa","Despre noi","Parteneri","Info","Contact","Noutati","Cariere","Kinetoterapie");
			else
				$arr_menu = array("Introducere&nbsp;&nbsp;&nbsp;"=>array("Producator", "Categorie", "Subcategorie", "Produs"),"Modificare&nbsp;&nbsp;&nbsp;"=>array("Producator", "Categorie", "Subcategorie", "Produs"),"Administrare cosuri","Administrare useri","Administrare reclame","Rapoarte","Pagini web");
            $myPage->setMenu($arr_menu);
            //$myPage->setLogo();
			
			//--IFRAME Start--
			
			if ( isset($_REQUEST["validare"]) && $_REQUEST["validare"] == 1 ) 
			{
				$pag = "validare.php?username=".$_REQUEST["username"]."&cod=".$_REQUEST["cod_validare"];
			}
			
			$body_content = '
				<iframe name="main_frame" id="main_frame" allowtransparency="true" style="width:97%;" frameborder="0" marginwidth="0" marginheight="0" src="'.$pag.'" scrolling="no"></iframe>
			';
			//-- IFRAME End--
			
            // -- Setez partea din stanga a body-ului START --
			// caseta categorii de produse - START -
            $myPage->body_left_content = "";
            $categories_list = "";
            $str_cat = "SELECT denumire, id FROM categorii ORDER BY denumire";
            $q_cat = mysql_query($str_cat) or die("Eroare aparuta la preluarea categoriilor de produse!");
            while ( $rs_cat = mysql_fetch_array($q_cat) )
            {
                $categories_list .= "<li onmouseover=\"document.getElementById('subcat_menu_".$rs_cat["id"]."').style.display='block';\" onmouseout=\"document.getElementById('subcat_menu_".$rs_cat["id"]."').style.display='none';\"><a onclick=\"document.getElementById('main_frame').src='ro/produse.php?mod=2&id_catprod=".$rs_cat["id"]."'\" href='javascript:void(0);'>".$rs_cat["denumire"]."</a>";
                $categories_list .= "<ul id='subcat_menu_".$rs_cat["id"]."' style='display:none;' >";
				$sql_subcat = "SELECT id, denumire FROM subcategorii WHERE id_categ = ".$rs_cat["id"]." ORDER BY denumire";
				$query_subcat = mysql_query($sql_subcat);
				if (mysql_numrows($query_subcat) > 0)
				{
					while ($row_subcat = mysql_fetch_array($query_subcat))
					{
						$categories_list .= "<li><a onclick=\"document.getElementById('main_frame').src='ro/produse.php?mod=2&id_subcat=".$row_subcat["id"]."'\" href='javascript:void(0);'>".$row_subcat["denumire"]."</a></li>";
					}
				}
				$categories_list .= "</ul></li>";
            }
            $produse_categorii = "
            <div class='left_caseta'>
                <div class='header_produse'></div>
                <div class='caseta_content'>
                    <ul id='categorii_produse'>
                        ".$categories_list."
                    </ul>
                </div>
                <div class='caseta_bottom'></div>
            </div>
            ";
			$myPage->body_left_content .= $produse_categorii;
			// caseta categorii de produse - STOP -

			/*
			// caseta de producatori - START -
			$producatori_list = "";
            $str_prod = "SELECT denumire,id FROM producatori ORDER BY denumire";
            $q_prod = mysql_query($str_prod) or die("Eroare aparuta la preluarea producatorilor!");
            while ( $rs_prod = mysql_fetch_array($q_prod) )
            {
                $producatori_list .= "<li><a href='javascript: return false;' onclick=\"document.getElementById('main_frame').src='ro/produse.php?mod=2&id_pr=".$rs_prod["id"]."'\">".$rs_prod["denumire"]."</a></li>";
            }
            $producatori = "
            <div class='left_caseta'>
                <div class='header_producatori'></div>
                <div class='caseta_content'>
                    <ul>
                        ".$producatori_list."
                    </ul>
                </div>
                <div class='caseta_bottom'></div>
            </div>
            ";
            $myPage->body_left_content .= $producatori;
			// caseta de producatori - STOP -
			*/
			
			// caseta de link-uri utile - START -
			
			$producatori_list = "";
            $str_prod = "SELECT denumire,link FROM producatori ORDER BY denumire";
            $q_prod = mysql_query($str_prod) or die("Eroare aparuta la preluarea producatorilor(link-ri utile)!");
            while ( $rs_prod = mysql_fetch_array($q_prod) )
            {
				if (substr($rs_prod["link"],0,4) == "http" )
					$producatori_list .= "<li><a href=\"".$rs_prod["link"]."\" target='_blank'>".$rs_prod["denumire"]."</a></li>";
				else
					$producatori_list .= "<li><a href=\"http://".$rs_prod["link"]."\" target='_blank'>".$rs_prod["denumire"]."</a></li>";
            }
            $producatori = "
            <div class='left_caseta'>
                <div class='header_linkuri_utile'></div>
                <div class='caseta_content'>
                    <ul>
                        ".$producatori_list."
                    </ul>
                </div>
                <div class='caseta_bottom'></div>
            </div>
            ";
            $myPage->body_left_content .= $producatori;
			
			// caseta de link-uri utile - STOP -
            // -- Setez partea din stanga a body-ului STOP --
            
			// Setez partea din dreapta a body-ului -START -
            // Afisez caseta de cos - STOP
			if (!isset($_SESSION["tipusr"]) || $_SESSION["tipusr"] > 2)
            {
				$myPage->body_right_content .= '
				<div id="cos_div">
					<iframe name="cos_frame" id="cos_frame" width=100 height=50 frameborder=0 src="" style="display: none;"></iframe>
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
						<input type="button" id="btn_vezi_cos" onmouseover="this.style.cursor=\'pointer\';" onclick="document.getElementById(\'main_frame\').src=\'ro/cos_det.php\';">
						<br />
						<!--<input type="button" id="btn_cumpara_acum" onmouseover="this.style.cursor=\'pointer\';" onclick="top.document.getElementById(\'main_frame\').src=\'final_cos.php?curier=\'+document.getElementById(\'curier\').value;">-->
						<input type="button" id="btn_reset_cos" onmouseover="this.style.cursor=\'pointer\';" onclick="document.getElementById(\'cos_frame\').src=\'cos.php?reset_cos=1;\';">
					</div>
				</div>    
				';
			}
            // Afisez caseta de cos - STOP
            
            // Afisez caseta de login - START
			if ( isset($_SESSION["auth"]) && $_SESSION["auth"] == "da" && isset($_SESSION["err"]) && $_SESSION["err"] == "fara" )
			{	
				$myPage->body_right_content .= '
				<div id="login_div">
						<form method="post" action="logout.php" target="_self" style="margin-top:5px;">
							'.$_SESSION["mesaj_auth"].'
							<br />
							<a class="login" href="javascript:;" onclick="document.getElementById(\'main_frame\').src=\'modif_cont.php\';">&nbsp;Modificare detalii cont&nbsp;</a>
							<br />
							<div style="width: 100%; text-align: center;">
								<input class="submit" style="margin-top:20px;" title="Deconectare utilizator" type="submit" value="Deconectati-va" style="margin-bottom:5px" onmouseover="this.style.cursor=\'pointer\';">
							</div>
						</form>
				</div>
				';
			}
			if ( !isset($_SESSION["err"]) || $_SESSION["err"] != "fara" || !isset($_SESSION["auth"]) || $_SESSION["auth"] != "da" )
			{
				$myPage->body_right_content .= '
				<div id="login_div">
					<form id="auth_usr" name="auth_usr" method="post" action="auth.php" target="_self">
						<input type="text" value="utilizator" class="input" id="usrid" name="usrid" onblur="if(this.value==\'\') { this.value=\'utilizator\';}" onfocus="this.value=\'\';" />
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
			/*
			if ( isset($_SESSION["auth"]) && $_SESSION["auth"] == "da" && $_SESSION["err"] == "fara" )
			{
				$myPage->body_right_content .= "<div id='istoric_div' align='center' title='Istoric cumparaturi' onmouseover=\"this.style.cursor='pointer';\" onclick=\"document.getElementById('main_frame').src='ro/istoric.php';\">Istoric cumparaturi</div>";
			}*/
			
			if ( !isset($_SESSION["tipusr"]) || $_SESSION["tipusr"] > 2 )
			{
				// preluare informatii statistice
				$return = array();
				$sql_vizitate = "SELECT count(a.id) as vizite, b.nume as produs, b.id as id FROM vizionari a, produse b WHERE b.id = a.id_prod GROUP BY a.id_prod ORDER BY vizite desc LIMIT 0,5";
				//$return["error_msg"] = ;

				$q_vizitate = mysql_query($sql_vizitate) or die("Eroare preluare cele mai vizitate produse!". mysql_error());
				$output_vizitate = "<ol>";
				while ($row_vizitate = mysql_fetch_array($q_vizitate))
				{
					$output_vizitate .= "<li onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=1&id_produs=".$row_vizitate["id"]."';\">".substr(ucfirst($row_vizitate[1]),0,22)."</li>";
				}
				$output_vizitate .= "</ol>";
				$return["continut_vizitate"] = $output_vizitate;


				$sql_vandute = "SELECT * FROM cos WHERE validat = 1";
				$q_vandute = mysql_query($sql_vandute) or die("Eroare preluare cele mai vandute produse!". mysql_error());
				$produse = array();
				$cant = array();
				while ($row_vandute= mysql_fetch_array($q_vandute))
				{
					$produse_row = explode(",",$row_vandute["produse"]) ;
					$cant_row = explode(",", $row_vandute["cantitati"]);
					foreach ($produse_row as $key => $value)
					{
						if (in_array($value,$produse))
						{
							$cant[$value] += $cant_row[$key];
						}
						else
						{
							$arr_ids = explode("_", $value);
							$produse[] = $arr_ids[0];
							$cant[$arr_ids[0]] = $cant_row[$key];
						}
					}
				}
				arsort($cant);
				$output_vandute = "<ol>";
				foreach ($cant as $key => $value)
				{
					$sql_prod = "SELECT nume FROM produse WHERE id = ".$key;
					$rez = mysql_query($sql_prod) or die("Nu gasesc numele pentru cele mai vandute produse!");
					if(mysql_num_rows($rez)>0)
					{
						$produs = mysql_fetch_array($rez); 
						$output_vandute .= "<li onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=1&id_produs=".$key."';\">".substr(ucfirst($produs[0]),0,22)."</li>";
					}
				}
				$output_vandute .= "</ol>";
				$return["continut_vandute"] = $output_vandute;
				// final preluare informatii statistice

				// Afisez caseta de cele mai vandute - START
				$myPage->body_right_content .= '
					<div id="cele_mai_vandute_div">
						'.$return["continut_vandute"].'
					</div>
					';
				// Afisez caseta de cele mai vandute - STOP

				// Afisez caseta de cele mai vizitate - START
				$myPage->body_right_content .= '
					<div id="cele_mai_vizitate_div">
						'.$return["continut_vizitate"].'
					</div>
					';
				
				// Afisez caseta de cele mai vizitate - STOP
				// Setez partea din dreapta a body-ului -STOP -
			}
			$myPage->setBodyContent($body_content);
            echo $myPage->newPage();
        ?>
    </body>
</html>
