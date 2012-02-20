<?php
  session_start();
?>
<html>
<head>
    <title>Istoric cumparaturi</title>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="description" content="Ortoprotetica - Istoric cumparaturi">
    <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
    <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">    
</head>
<body>
    <div class="titlu_mic">Istoric cumparaturi</div>
    <?
    include("../inc/global.php");
    $sql_ist = "SELECT * FROM cos WHERE id_user = ".$_SESSION["id_user"]." ORDER BY STR_TO_DATE(data,'%d,%m,%Y')";
    $q_ist = mysql_query($sql_ist) or die ("Eroare preluare istoric cosuri !");
    $tabel = "
    <table cellspacing=0 cellpadding=2 style='white-space: nowrap; border:1px solid #000;'>
        <tr>
            <th rowspan=2 style='border:1px solid #000;'>Op.</th>
            <th rowspan=2 style='border:1px solid #000;'>Data comanda</th>
            <th colspan=4>Produse</th>
        </tr>
        <tr>
            <th>Denumire</th>
            <th>Cantitate</th>
            <th>Pret</th>
            <th>Valoare</th>
        </tr>
        ";
        
    while ( $rs_ist = mysql_fetch_array($q_ist) )
    {
        $arr_prod = explode(",",$rs_ist[3]);
        $arr_cant = explode(",",$rs_ist[6]);
        $tabel .= "
            <tr>
                <td style='border-right:1px solid #000 ;vertical-align: middle;' rowspan='".(count($arr_prod)+1)."'>
                    &nbsp;<input type='image' border=1 src='../ico/trimite.png' onmouseover=\"this.style.cursor='pointer'\" title='Repeta comanda' onclick=\"this.src='../ico/trimite_disabled.png'; this.disabled='true'; document.getElementById('reincarca').src='reload_cos.php?idcos=".$rs_ist[0]."';\">&nbsp;
                </td>
                <td style='border-right:1px solid #000; vertical-align: middle;' rowspan='".(count($arr_prod)+1)."'>
                    ".$rs_ist[1]."
                </td>";
        $total = 0;
        for ($i=0;$i<count($arr_prod);$i++ )
        {
            $sql_denprod = "SELECT nume, pret FROM produse WHERE id = ".$arr_prod[$i] ;
            $q_denprod = mysql_query($sql_denprod) or die ("Eroare preluare denumire produs!") ;
            $rs_denprod = mysql_fetch_array($q_denprod);
            if ( $i==0 )
            {
                $tabel .= "
                        <td align=left>
                            <a title='Detalii produs' href='javascript:;' onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=1&id_produs=".$arr_prod[$i]."';\">".$rs_denprod[0]."</a>
                        </td>
                        <td align=center>
                            ".$arr_cant[$i]."
                        </td>
                        <td align=right>
                            ".$rs_denprod[1]."
                        </td>
                        <td align=right>
                            ".round($arr_cant[$i]*$rs_denprod[1],2)."
                        </td>
                    </tr>
                ";
            }
            else
            {
                $tabel .= "
                    <tr>
                        <td align=left>
                            <a title='Detalii produs' href='javascript:;' onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=1&id_produs=".$arr_prod[$i]."';\">".$rs_denprod[0]."</a>
                        </td>
                        <td align=center>
                            ".$arr_cant[$i]."
                        </td>
                        <td align=right>
                            ".$rs_denprod[1]."
                        </td>
                        <td align=right>
                            ".round($arr_cant[$i]*$rs_denprod[1],2)."
                        </td>
                    </tr>";
            }
            $total += round($arr_cant[$i]*$rs_denprod[1],2);
            //mysql_close($q_denprod);
        }
        $tabel .= "
        <tr>
            <td colspan=3 align=center  style='border-top: 1px solid #999;'>TOTAL</td>
            <td align=right style='border-top: 1px solid #999;'>".$total."</td>
        </tr>
        ";
    }
    $tabel .= "</table>
    ";
    echo $tabel;
    ?>
    <iframe frameborder="0" height="0" width="0" marginheight="0" marginwidth="0" id="reincarca" name="reincarca" scrolling="no" src=""></iframe>
</body>
</html>