<?
session_start();
if ( isset($_SESSION["auth"]) && $_SESSION["auth"] == "da" )
{
     include("../inc/global.php");
     $sql_date = "SELECT * FROM produse WHERE id=".$_REQUEST["id"];
     $q_date = mysql_query($sql_date);
     $rs_date = mysql_fetch_array($q_date);
     $str_arr = split("\r",$rs_date[2]) ;
     $str_des = "";
     for ($i=0; $i<count($str_arr); $i++)
        $str_des .= $str_arr[$i]."\\n\\";
     $str_des = substr($str_des,0,(strlen($str_des)-3));
     $str_arr1 = split("\r",$rs_date[11]) ;
     $str_ind = "";
     for ($i=0; $i<count($str_arr1); $i++)
        $str_ind .= $str_arr1[$i]."\\n\\";
     $str_ind = substr($str_ind,0,(strlen($str_ind)-3));
     echo "
     <script>
        parent.document.getElementById('id_produs').value='".$rs_date[0]."';
        parent.document.getElementById('id').value='".$rs_date[0]."';
        parent.document.getElementById('nume').value='".$rs_date[1]."';
        parent.document.getElementById('descriere').value='".$str_des."';
        parent.document.getElementById('pret').value='".$rs_date[3]."';
        parent.document.getElementById('indicatii').value='".$str_ind."';
        parent.document.getElementById('reducere').value='".$rs_date[8]."';
        var cat = parent.document.getElementById('categorie');
        for (i=1;i<cat.options.length;i++)
            if (cat.options[i].value==".$rs_date[4].")
                cat.options[i].selected = true;
        var prod = parent.document.getElementById('producator');
        for (i=1;i<prod.options.length;i++)
            if (prod.options[i].value==".$rs_date[5].")
                prod.options[i].selected = true;
        if ( '$rs_date[7]' == 'da' )
            parent.document.getElementById('ptcopii').options[1].selected=true;
        else
            parent.document.getElementById('ptcopii').options[0].selected=true;
        if ( '$rs_date[9]' == 'da' )
            parent.document.getElementById('prima_pagina').options[1].selected=true;
        else
            parent.document.getElementById('prima_pagina').options[0].selected=true;
        if ( '$rs_date[10]' == 'da' )
            parent.document.getElementById('super_oferta').options[1].selected=true;
        else
            parent.document.getElementById('super_oferta').options[0].selected=true;
        var af = parent.document.getElementById('afectiune[]');
        var af_arr = '$rs_date[6]'.split(',');
        for (i=1;i<af.options.length;i++)
            if (af_arr.indexOf(af.options[i].value) >= 0 )
                af.options[i].selected = true;
     </script>
     ";
}
?>