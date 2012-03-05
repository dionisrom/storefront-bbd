<?php
  session_start();
?>
<html>
<head>
	<title>Validare cosuri de cumparaturi</title>
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta name="description" content="Ortoprotetica - Validare cosuri de cumparaturi">
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
	<div class="titlu_mic">Validare cosuri de cumparaturi</div>
	<?
	include("../inc/global.php");
	$data_validare = strftime('%d.%m.%Y',time());
	$sql_upd = "UPDATE cos SET validat=1, data_validare = '".$data_validare."', ora_validare = '".strftime('%H:%M:%S',time())."' WHERE id = ".$_REQUEST["idcos"];
	mysql_query($sql_upd) or die("Eroare validare cos!");
	
	// --------------------------------- CREARE FACTURA PROFORMA -----------------------------------
	include("../html2fpdf/html2fpdf.php");
	$pdf = new HTML2FPDF($orientation='P',$unit='mm',$format='A4');
	$pdf->AddPage();
	$pdf->temporaire("Factura proforma");
    $pdf->Image('../img/sigla_fact.jpg',20,8,75);
    $pdf->SetFont('Arial','B');
    $pdf->SetFontSize(14);
    $pdf->Text(120,13,"FACTURA PROFORMA");
    $pdf->SetFont('Arial');
    $pdf->SetFontSize(10);
    //$pdf->Text(140,17,"Nr factura:");
    //$pdf->Text(180,17,"");
    $pdf->Text(120,21,"Data:");
    //$pdf->Text(180,21,date("Y-m-d",time()));
    $pdf->Text(145,21,$data_validare);
    $pdf->Text(120,25,"Data expedierii:");
    //$pdf->Text(180,25,date("Y-m-d",time()));
    $pdf->Text(145,25,$data_validare);
    $pdf->Text(120,29,"Cod comanda:");
    $pdf->Text(145,29,"".$_REQUEST["idcos"]);
    //$pdf->Text(150,33,"Re: No commande");
    //$pdf->SetXY(10,60);
    $pdf->SetFont('Arial','B');
    //$pdf->Text(30,65,"Vandut la:");
    $pdf->Text(120,40,"Cumparator:");
    $pdf->SetFontSize(8);
    $pdf->SetFont('Arial');
    //------------------------ date cumparator ---------------------------
    $q_pers = mysql_query("SELECT useri.* FROM cos, useri WHERE cos.id = ".$_REQUEST["idcos"]." and useri.id = cos.id_user");
    $rs_pers = mysql_fetch_array($q_pers);
    $pdf->Text(120,45,"Nume:");
    $pdf->Text(140,45,$rs_pers[1]." ".$rs_pers[2]);
    $pdf->Text(120,49,"Adresa:");
    $pdf->Text(140,49,$rs_pers[16].", ".$rs_pers[4]);
    $pdf->Text(120,53,"Cod postal:");
    $pdf->Text(140,53,$rs_pers[11]);
    $pdf->Text(120,57,"Telefon:");
    $pdf->Text(140,57,$rs_pers[5]);
    $pdf->Text(120,61,"Telefon mobil:");
    $pdf->Text(140,61,$rs_pers[12]);
    $pdf->Text(120,65,"Email:");
    $pdf->Text(140,65,$rs_pers[6]);
    $pdf->Text(120,69,"Fax:");
    $pdf->Text(140,69,$rs_pers[13]);
    //-------------------- final date cumparator ------------------------- 
    $pdf->RoundedRect(20, 90, 180, 150, 3, '1234', 'D');
    $pdf->RoundedRect(20, 241, 180, 25, 3, '1234', 'D');
    $pdf->Line(20,100,200,100);
    $pdf->Text(25,95,"Nr.crt");
    $pdf->Text(35,95,"Denumirea produselor / serviciilor");
    $pdf->Text(115,95,"UM");
    $pdf->Text(125,95,"Cant.");
    $pdf->Text(140,95,"Pret unitar");
    $pdf->Text(165,95,"Val. totala");
    $pdf->Text(185,95,"TVA");
    $pdf->Line(33,90,33,240);
    $pdf->Line(112,90,112,240);
    $pdf->Line(122,90,122,240);
    $pdf->Line(138,90,138,240);
    $pdf->Line(162,90,162,240);
    $pdf->Line(182,90,182,240);
    /*$pdf->Text(73,105,"Distribution Top Menu # ".$_REQUEST["contr"]." contrat");
    $pdf->Text(73,112,"secteur ".$rs[10]);
    $pdf->Text(73,119,"TPS ".$rs[3]."%");
    $pdf->Text(73,126,"TVQ ".$rs[4]."%");
    $pdf->Text(180,105,$rs[5].'');
    $pdf->Text(180,119,$rs[6].'');
    $pdf->Text(180,126,$rs[7]+$dif.'');
    $total=$rs[5]+$rs[6]+$rs[7]+$dif;*/
    $q_cos = mysql_query("SELECT produse, cantitati, masuri curier FROM cos WHERE id=".$_REQUEST["idcos"]);
    $rs_cos = mysql_fetch_array($q_cos);
    $q_prod = mysql_query("SELECT * FROM produse WHERE id IN (".$rs_cos[0].")");
    $i = 0;
    $cant_arr = explode(",",$rs_cos[1]);
    $masuri_arr = explode(",",$rs_cos[2]);
    $h=98;
    $pas = 8;
    $total = 0;
    $total_tva = 0;
    while ( $rs_prod = mysql_fetch_array($q_prod))
    {
		if ( $cant_arr[$i] > 0 )
        {
            if ( $rs_prod[8] > 0 )
            {
                $pretctva = round($rs_prod[3]*((100-$rs_prod[8])/100),2);
                $pret = round($pretctva/1.19,2);
            }
            else
            {
                $pretctva = $rs_prod[3];
                $pret = round($rs_prod[3]/1.19,2);
            }
		    $pdf->SetXY(20,$h+$pas*$i);
		    $pdf->Cell(20,10,$i+1,0,1,"C",0);
		    $pdf->SetXY(33,$h+$pas*$i);
            $pdf->SetFontSize(6.5);
		    $pdf->Cell(80,10,$rs_prod[1]."( masura ".$masuri_arr[$i].")",0,1,"L",0);
            $pdf->SetFontSize(8);
		    $pdf->SetXY(113,$h+$pas*$i);
		    $pdf->Cell(10,10,"buc",0,1,"L",0);
		    $pdf->SetXY(122,$h+$pas*$i);
		    $pdf->Cell(15,10,$cant_arr[$i],0,1,"R",0);
		    $pdf->SetXY(138,$h+$pas*$i);
		    $pdf->Cell(22,10,$pret,0,1,"R",0);
		    $pdf->SetXY(162,$h+$pas*$i);
		    $pdf->Cell(20,10,round($pret*$cant_arr[$i],2),0,1,"R",0);
		    $pdf->SetXY(182,$h+$pas*$i);
		    $pdf->Cell(17,10,round($pretctva*$cant_arr[$i],2)-round($pret*$cant_arr[$i],2),0,1,"R",0);
		    $total += round($pret*$cant_arr[$i],2);
		    $total_tva += round($pretctva*$cant_arr[$i],2)-round($pret*$cant_arr[$i],2);
        }
		$i++;
    }
    
    // Adaug transport
    if ( $rs_cos[2] == 0 )
    {
        $pdf->SetXY(20,$h+$pas*$i);
        $pdf->Cell(20,10,$i+1,0,1,"C",0);
        $pdf->SetXY(33,$h+$pas*$i);
        $pdf->SetFontSize(6.5);
        $pdf->Cell(80,10,"Taxe de curierat - Posta romana",0,1,"L",0);
        $pdf->SetFontSize(8);
        $pdf->SetXY(113,$h+$pas*$i);
        $pdf->Cell(10,10,"buc",0,1,"L",0);
        $pdf->SetXY(122,$h+$pas*$i);
        $pdf->Cell(15,10,"1",0,1,"R",0);
        $pdf->SetXY(138,$h+$pas*$i);
        $pdf->Cell(22,10,"10.08",0,1,"R",0);
        $pdf->SetXY(162,$h+$pas*$i);
        $pdf->Cell(20,10,round(10.08,2),0,1,"R",0);
        $pdf->SetXY(182,$h+$pas*$i);
        $pdf->Cell(17,10,round(1.92,2),0,1,"R",0);
        $total += round(10.08,2);
        $total_tva += round(1.92,2);
    }
    else
    {
        $pdf->SetXY(20,$h+$pas*$i);
        $pdf->Cell(20,10,$i+1,0,1,"C",0);
        $pdf->SetXY(33,$h+$pas*$i);
        $pdf->SetFontSize(6.5);
        $pdf->Cell(80,10,"Taxe de curierat - Cargus",0,1,"L",0);
        $pdf->SetFontSize(8);
        $pdf->SetXY(113,$h+$pas*$i);
        $pdf->Cell(10,10,"buc",0,1,"L",0);
        $pdf->SetXY(122,$h+$pas*$i);
        $pdf->Cell(15,10,"1",0,1,"R",0);
        $pdf->SetXY(138,$h+$pas*$i);
        $pdf->Cell(22,10,"21",0,1,"R",0);
        $pdf->SetXY(162,$h+$pas*$i);
        $pdf->Cell(20,10,round(21,2),0,1,"R",0);
        $pdf->SetXY(182,$h+$pas*$i);
        $pdf->Cell(17,10,round(4,2),0,1,"R",0);
        $total += round(21,2);
        $total_tva += round(4,2);    
    }
    // Final adaug transport
    
    
    $pdf->Line(122,241,122,266);
    $pdf->Line(162,241,162,266);
    $pdf->Line(182,241,182,260);
    $pdf->Line(182,241,182,260);
    $pdf->Line(162,260,200,260);
    $pdf->SetFont('Arial','B');
    $pdf->Text(128,258,"Valoare totala");
    $pdf->Text(168,258,$total.'');
    $pdf->Text(185,258,$total_tva.'');
    $pdf->SetTextColor(170,0,0);
    $pdf->SetFontSize(10);
    $pdf->Text(177,265,($total+$total_tva).'');
    $pdf->SetFont('Arial');
    $pdf->SetFontSize(8);
    $pdf->SetTextColor(0,0,0);
    //$pdf->Text(22,247,"Top Menu TPS: 868138496 RT001");
    //$pdf->Text(22,253,"Top Menu TVQ: 1020951032 TQ001");
    $pdf->Text(22,259,"Comentarii: MULTUMIM !");
    $pdf->Text(22,265,"");
    if (file_exists("../fact_proforma/proforma_".$_REQUEST["idcos"].".pdf"))
    {
		unlink("../fact_proforma/proforma_".$_REQUEST["idcos"].".pdf");
    }
    $pdf->Output("../fact_proforma/proforma_".$_REQUEST["idcos"].".pdf");
    $pdfdoc = $pdf->Output("","S");
	// ----------------------------- FINAL CREARE FACTURA PROFORMA ---------------------------------
	
    
	/*$headers = 	'From: webmaster@ortoprotetica.ro' . "\r\n" .
				'Reply-To: webmaster@ortoprotetica.ro' . "\r\n" .
				'Content-Type: multipart/mixed; boundary=\"PHP-mixed-'.$random_hash.'\"'. "\r\n";
	$attachment = chunk_split(base64_encode(file_get_contents("../fact_proforma/proforma_".$_REQUEST["idcos"].".pdf")));
	Va multumim pentru comanda facuta si va trimitem atasat factura proforma!
	*/

	// email stuff (change data below)
	$to=$_REQUEST["email"];
	$from = "webmaster@ortoprotetica.ro";
	$subject = "Factura proforma - Ortoprotetica";
	$message = "<p>Va multumim pentru comanda facuta si va trimitem atasat FACTURA PROFORMA pentru comanda cu codul ".$_REQUEST["idcos"]." !</p>";
	// a random hash will be necessary to send mixed content
	$separator = md5(time());
	// carriage return type (we use a PHP end of line constant)
	$eol = "\n";
	// attachment name
	$filename = "factura_proforma.pdf";
	// encode data (puts attachment in proper format)
	//$pdfdoc = $pdf->Output("", "S");
	$attachment = chunk_split(base64_encode($pdfdoc));
	// main header (multipart mandatory)
	$headers = "From: ".$from.$eol;
	$headers .= "MIME-Version: 1.0".$eol;
	$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol.$eol;
	$headers .= "Content-Transfer-Encoding: 7bit".$eol;
	$headers .= "This is a MIME encoded message.".$eol.$eol;
	// message
	$headers .= "--".$separator.$eol;
	$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
	$headers .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
	$headers .= $message.$eol.$eol;
	// attachment
	$headers .= "--".$separator.$eol;
	$headers .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol;
	$headers .= "Content-Transfer-Encoding: base64".$eol;
	$headers .= "Content-Disposition: attachment".$eol.$eol;
	$headers .= $attachment.$eol.$eol;
	$headers .= "--".$separator."--";
	// send message
	mail($to, $subject, "", $headers);
    echo "
    <script>
        alert('Cosul a fost validat cu succes si a fost trimis mailul cu factura proforma catre client !');
        top.document.getElementById('main_frame').src = 'ro/adm_cosuri.php';
    </script>
    ";
	?>
</body>
</html>
