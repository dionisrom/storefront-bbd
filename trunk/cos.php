<?php
  session_start();
  if ( isset($_REQUEST["reset_cos"]) && $_REQUEST["reset_cos"] == 1 )
  {
  	session_unregister("cos");
  	session_unregister("nr_produse");
  	session_unregister("id_produse");
  	session_unregister("cant_produse");
  	session_unregister("pret_produse");
  }
  if ( isset($_REQUEST["adauga_prod"]) && $_REQUEST["adauga_prod"] == 1 )
  {
	  if ( in_array($_REQUEST["id_prod"], $_SESSION["id_produse"]) )
	  {
		  for ($i=0; $i<=($_SESSION["nr_produse"]-1); $i++)
		  {
			  if ( $_REQUEST["id_prod"] == $_SESSION["id_produse"][$i] )
			  {
				  $_SESSION["cant_produse"][$i] += $_REQUEST["cant_prod"];
		  		  $_SESSION["pret_produse"][$i] = $_REQUEST["pret_prod"];
		  		  $_SESSION["cos"] = "plin" ;
			  }
		  }
	  }
	  else
	  {
		  if ( isset($_SESSION["nr_produse"]) )
		  {
  			$_SESSION["nr_produse"] += 1 ;
  			$_SESSION["cos"] = "plin" ;
		  }
		  else
		  {
			  $_SESSION["nr_produse"] = 1;
			  $_SESSION["cos"] = "plin" ;
		  }
		  
		  $nr_crt = $_SESSION["nr_produse"] - 1;
		   
  		  $_SESSION["id_produse"][$nr_crt] = $_REQUEST["id_prod"];
		  $_SESSION["cant_produse"][$nr_crt] = $_REQUEST["cant_prod"];
		  $_SESSION["pret_produse"][$nr_crt] = $_REQUEST["pret_prod"];
	  }
  }
  if ($_SESSION["nr_produse"]>0)
  {
	  $total = 0;
	  $tabel_cos = "
	  <script>
  	  ";
	  for ($i=0; $i<=($_SESSION["nr_produse"]-1); $i++)
	  {
          $total += $_SESSION["cant_produse"][$i]*$_SESSION["pret_produse"][$i] ;
	  }
      $tabel_cos_div = "<div align='left' style='padding-left: 7px;'>Produse in cos: ".$_SESSION["nr_produse"];
      $tabel_cos_div .= "<br />Total cumparaturi: ".$total." Lei</div>";
	  $tabel_cos .= "     top.document.getElementById('continut_cos').innerHTML = \"".$tabel_cos_div."\";
      </script>
	  ";
  } 
  else
  {
  	 $tabel_cos = " 
  	 <script>
  		top.document.getElementById('continut_cos').innerHTML=\"<br /><br />Cosul este gol!<br /><br />\";
  	 </script>
  	 ";
  }
  echo $tabel_cos;
  
?>
