<?php
  session_start();
  if ( isset($_REQUEST["idcos"]) )
  {
      $form = "";
      include("../inc/global.php");
      $strq = "SELECT * FROM cos WHERE id = ".$_REQUEST["idcos"]."";
      
      echo $strq;;
      $qcos = mysql_query($strq) or die("Eroare la preluare cos pentru reincarcare!");
      $rs = mysql_fetch_array($qcos);
      
      $arr_prod = explode(",",$rs[3]);
      $arr_cant = explode(",",$rs[6]);
      for ($i=0; $i<count($arr_prod); $i++)
      {
          $qprod = mysql_query("SELECT pret FROM produse WHERE id = ".$arr_prod[$i]); 
          $rsprod = mysql_fetch_array($qprod);
          $form .= "
          <form id='prod_".$i."' method='post' target=\"top.document.getElementById('cos_frame')\" action='../cos.php'>
            <input type=hidden id='adauga_prod' name='adauga_prod' value='1'>
            <input type='hiden' id='id_prod' name='id_prod' value='".$arr_prod[$i]."'>
            <input type='hiden' id='cant_prod' name='cant_prod' value='".$arr_cant[$i]."'>
            <input type='hiden' id='pret_prod' name='pret_prod' value='".$rsprod[0]."'>
          </form>
          ";
          echo 
          "<script>
            top.document.getElementById('cos_frame').src=\"../cos.php?adauga_prod=1&id_prod=".$arr_prod[$i]."&cant_prod=".$arr_cant[$i]."&pret_prod=".$rsprod[0]."\";
          </script>
          ";
      }
      
  }
?>
