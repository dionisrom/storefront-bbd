<?
    session_start();
?>
<html>
<head>
	<title>Acasa</title>
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta name="description" content="Medical Active - Acasa">
	<meta name="copyright" content="&copy; 2009 Medical Active SRL" />
    <script type="text/javascript" src="../js/easyslider/jquery.js"></script> 
    <script type="text/javascript" src="../js/easyslider/easySlider1.7.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){    
            $("#slider").easySlider({
                auto: true, 
                continuous: true,
                numeric: true
            });
        });    
    </script>
    <link href="../css/easyslider.css" rel="stylesheet" type="text/css" media="screen" />
	<LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
    
</head>
<body>

<?
    include("../inc/global.php");
    $inputs = "";
    $sql_produse = "SELECT a.id, a.nume, a.descriere, a.pret, a.reducere, b.denumire FROM produse a LEFT JOIN categorii b ON b.id = a.id_categorie WHERE prima_pagina like 'da'";
    $q_produse = mysql_query($sql_produse) or die("Eroare preluare produse!");
    $tabel = "
    <!-- slider -->
    <div id='container'>

        <div id='content'>
            <div id='slider'>
                <ul>                
                    <li><a href=''><img src='../images/slider/01.jpg' alt='Css Template Preview' /></a></li>
                    <li><a href=''><img src='../images/slider/02.jpg' alt='Css Template Preview' /></a></li>
                    <li><a href=''><img src='../images/slider/03.jpg' alt='Css Template Preview' /></a></li>
                    <li><a href=''><img src='../images/slider/04.jpg' alt='Css Template Preview' /></a></li>
                    <li><a href=''><img src='../images/slider/05.jpg' alt='Css Template Preview' /></a></li>            
                </ul>
            </div>
        </div>
    </div>
    <!-- slider -->
    <br />
    <div id='produse'>";
    while ($rs_produse = mysql_fetch_array($q_produse))
    {
        $image = "&nbsp;";
        $image = "<img src='../images/no_foto.jpg' class='img_caseta_prod' alt='' />";
        if ( file_exists("../images/produse/".$rs_produse[0].".jpg") )
        {
            $image = "<img src='../images/produse/".$rs_produse[0].".jpg' class='img_caseta_prod' alt='' />";
        }
        if ( file_exists("../images/produse/".$rs_produse[0].".gif") )
        {
            $image = "<img src='../images/produse/".$rs_produse[0].".gif' class='img_caseta_prod' alt='' />";
        }
        if ( $rs_produse[4] > 0 )
        {
            $pret = "<font style='text-decoration: line-through;'>".$rs_produse[3]."</font>&nbsp;&nbsp;".$rs_produse[3]*((100-$rs_produse[4])/100);
            $pret_ron = $rs_produse[3]*((100-$rs_produse[4])/100);
        }
        else
        {
            $pret = $rs_produse[3];
            $pret_ron = $rs_produse[3];
        }
        $tabel .= "
             <div class='caseta_prod'>
				<div class='categorie_prod_top'>$rs_produse[5]</div>
                <div style='text-align:center;' title='".$rs_produse[1]."' onmouseover=\"this.style.cursor='pointer';\" onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=1&id_produs=".$rs_produse[0]."';\">".$image."</div>
                <div class='nume_prod'>".substr($rs_produse[1],0,20)."</div>
                <div class='pret_div'>pret <span class='pret'>".$pret."</span> Lei <input type='button' onmouseover=\"this.style.cursor='pointer';\" title='Detalii despre produs' class='detalii_prod' onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=1&id_produs=".$rs_produse[0]."';\" /></div>
                <div class='descript_prod'>".substr(trim($rs_produse[2]),0,70)."...</div>
                <div class='prod_in_cos'>Cantitate: <input type='text' class='input' id='cant_".$rs_produse[0]."' id='cant_".$rs_produse[0]."' value='0' size=4 /> <input type='button' title='Adauga in cos' class='add_to_cart' onmouseover=\"this.style.cursor='pointer';\" onclick=\"if (document.getElementById('cant_".$rs_produse[0]."').value>0) {top.document.getElementById('cos_frame').src='cos.php?adauga_prod=1&cant_prod='+document.getElementById('cant_".$rs_produse[0]."').value+'&pret_prod=".$pret_ron."&id_prod=".$rs_produse[0]."';} else {alert('Nu ati completat cantitatea dorita ! ')};\" /></div>
             </div>
            ";  
    }
    $tabel .= "
        </div>
    ";
    echo $tabel;
?>
    
</body>
</html>