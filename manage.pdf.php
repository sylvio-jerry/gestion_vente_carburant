<?php 
    include('connection.php');
    require_once('FPDF/fpdf.php');
    
    // header function
    function headerClientPdf($file){
        // Logo
        $file->Image('FPDF/YouTube.png',10,6,30);
        // Police Arial gras 15
        $file->SetFont('Arial','B',20);
        // Décalage à droite
        $file->Cell(80);
        // Titre
        $file->Cell(50,20,'Liste de client',1,0,'C');
        // Saut de ligne
        $file->Ln(30);
    }

    // exporte data client
    if(isset($_POST['exportClientPdf'])){
        $allclient="SELECT * FROM client";
        $data=mysqli_query($mysqli,$allclient);
        $pdf=new FPDF('P','mm','A4');// L: Landscape, P: Portrait
        $pdf->Addpage();
        $pdf->SetFont('Arial','B','14');
        headerClientPdf($pdf);
        $pdf->cell('45','10','Code Client','1','0','c');
        $pdf->cell('125','10','Nom','1','1','c');
        while($row=mysqli_fetch_assoc($data)){
            $pdf->cell('45','15',$row['codecli'],'1','0','c');
            $pdf->cell('125','15',$row['nomcli'],'1','1','c');
        }
        $pdf->Output();
    }

    // exporte data client carburant

    function headerCarburantPdf($file){
        // Logo
        $file->Image('FPDF/YouTube.png',10,6,30);
        // Police Arial gras 15
        $file->SetFont('Arial','B',20);
        // Décalage à droite
        $file->Cell(80);
        // Titre
        $file->Cell(65,20,'Liste de carburant',1,0,'C');
        // Saut de ligne
        $file->Ln(30);
    }

    if(isset($_POST['exportCarburantPdf'])){
        $allcarbu="SELECT * FROM carburant";
        $data=mysqli_query($mysqli,$allcarbu);
        $pdf=new FPDF('P','mm','A4');
        $pdf->Addpage();
        $pdf->SetFont('Arial','B','14');
        headerCarburantPdf($pdf);
        $pdf->cell('35','10','NUMERO','1','0','c');
        $pdf->cell('70','10','CARBURANT','1','0','c');
        $pdf->cell('35','10','PU','1','0','c');
        $pdf->cell('40','10','STOCK','1','1','c');
        while($row=mysqli_fetch_assoc($data)){
            $pdf->cell('35','15',$row['numcarburant'],'1','0','c');
            $pdf->cell('70','15',$row['design'],'1','0','c');
            $pdf->cell('35','15',$row['pu'],'1','0','c');
            $pdf->cell('40','15',$row['stock'],'1','1','c');
        }
        $pdf->Output();
    }

    //exporte data liste achat
    function headerListeAchatPdf($file){
        // Logo
        $file->Image('FPDF/YouTube.png',10,6,30);
        // Police Arial gras 15
        $file->SetFont('Arial','B',20);
        // Décalage à droite
        $file->Cell(80);
        // Titre
        $file->Cell(65,20,"Liste d'achat ",1,0,'C');
        // Saut de ligne
        $file->Ln(30);
    }

    if(isset($_POST['exportAchatPdf'])){
        $sql = "SELECT design, nomcli, dateachat, pu, qte, pu*qte as montant
                FROM carburant c, client cli, achat achat 
                WHERE (c.numcarburant = achat.numcarburant) AND (cli.codecli = achat.codecli);";
        $data=mysqli_query($mysqli,$sql);
        $pdf=new FPDF('P','mm','A4');
        $pdf->Addpage();
        headerListeAchatPdf($pdf);
        $pdf->SetFont('Arial','B','14');
        $pdf->cell('50','15','CARBURANT','1','0','c');
        $pdf->cell('35','15','CLIENT','1','0','c');
        $pdf->cell('35','15','DATE','1','0','c');
        $pdf->cell('20','15','PU','1','0','c');
        $pdf->cell('17','15','QTE','1','0','c');
        $pdf->cell('30','15','MONTANT','1','1','c');
        
        while($row=mysqli_fetch_assoc($data)){
            $pdf->SetFont('Arial','B','14');
            $pdf->cell('50','15',$row['design'],'1','0','c');
            $pdf->cell('35','15',$row['nomcli'],'1','0','c');
            $pdf->cell('35','15',$row['dateachat'],'1','0','c');
            $pdf->cell('20','15',$row['pu'],'1','0','c');
            $pdf->cell('17','15',$row['qte'],'1','0','c');
            $pdf->cell('30','15',$row['montant'],'1','1','c');
        }
        $pdf->Output();
    }

       //exporte data FACTURE--------------
    //    FONCTION HEAD FACTURE-----------------------------


    function headerFacturePdf($file){
    // Logo
    $file->Image('FPDF/YouTube.png',10,6,30);
    // Police Arial gras 15
    $file->SetFont('Arial','B',20);
    // Décalage à droite
    $file->Cell(80);
    // Titre
    $file->Cell(45,15,"FACTURE ",0,0,'C');
    // Saut de ligne
    $file->Ln(30);
}
function NameClientQuerryy(){
    global $mysqli;
    $client_selected=$_GET['GET_ID_CLI'];
    $sql="SELECT nomcli as Nom FROM client WHERE codecli='$client_selected';";
    $res=mysqli_query($mysqli, $sql);
    if($res){
        return $res;
    }
    else{
        echo 'error,check the query';
    }
}

function showNamee(){
    $getName=NameClientQuerryy();
    while($row=mysqli_fetch_assoc($getName)){
        $nomcliFact=$row['Nom'];
    }
    return $nomcliFact;
}
    function refFactt(){
            global $mysqli;
            $client_selected=$_GET['GET_ID_CLI'];
            $trans= str_ireplace('Cli-','Ref-',$client_selected);
            return $trans;
    }

    function codeFaa(){
        global $mysqli;
        $code=$_GET['GET_ID_CLI'];
        return $code;
    }
    
    function datefaa(){
        setlocale(LC_TIME, 'fr_FR');
        $daty=date('d-m-Y');
        return $daty;
    }
    
    function heurefaa(){
        setlocale(LC_TIME, 'fr_FR');
        $lera=date('H:i:s');
        return $lera;
    }
    function AmountFacturee(){
        global $mysqli;
        $client_selected=$_GET['GET_ID_CLI'];
        $sql = "SELECT SUM(pu*qte) as somme
                FROM carburant c, achat a
                WHERE (c.numcarburant = a.numcarburant) AND (a.codecli = '$client_selected');";
        $res = mysqli_query($mysqli, $sql);
        if($res){
            return $res;
        }
        else{
            affiche_message('error', "erreur query !");
        }
    }
    function showAmountt(){
        $getS=AmountFacturee();
        while($row=mysqli_fetch_assoc($getS)){
            $som=$row['somme'];
        }
        return $som;
    }



    if(isset($_POST['exportFacturePdf'])){
        global $mysqli;
        $refer=refFactt();
        $NumCli=codeFaa();
        $Nomcli=showNamee();
        $heure=heurefaa();
        $date=datefaa();
        $somme=showAmountt();
        $letter=convertStr($somme);
        $valueMaj=strtoupper($letter);
        $client_selected=$_GET['GET_ID_CLI'];
        $sql = "SELECT c.design as CARBURANT, c.pu as PU, a.qte as QUANTITE, pu*qte as MONTANT 
                FROM carburant c, achat a
                WHERE (c.numcarburant = a.numcarburant) AND (a.codecli = '$client_selected');";
        $data=mysqli_query($mysqli,$sql);

        $pdf=new FPDF('P','mm','A4');
        $pdf->Addpage();
        headerFacturePdf($pdf);

        $pdf->cell(102);

        $pdf->cell('25','10','Facture Numero :','0','0','c');
        $pdf->cell(35);
        $pdf->cell('20','10', $refer,'0','1','c');

        $pdf->cell('10','10','Nom :','0','0','c');
        $pdf->cell(12);
        $pdf->cell('40','10',$Nomcli,'0','0','c');

        // $pdf->Ln(7);

        $pdf->cell(40);
        $pdf->cell('10','10','Date: ','0','0','c');
        $pdf->cell(10);
        $pdf->cell('45','10',$date,'0','1','c');

        // $pdf->Ln(7);

        $pdf->cell('25','10','NClient :','0','0','c');
        $pdf->cell(7);
        $pdf->cell('25','10',$NumCli,'0','0','c');

        // $pdf->Ln(7);
        $pdf->cell(45);
        $pdf->cell('10','15','Heure :','0','0','c');
        $pdf->cell(15);
        $pdf->cell('25','15',$heure,'0','1','c');

        $pdf->Ln(7);

        $pdf->SetFont('Arial','B','14');
        $pdf->cell('55','15','CARBURANT','1','0','c');
        $pdf->cell('35','15','PU','1','0','c');
        $pdf->cell('45','15','QUANTITE','1','0','c');
        $pdf->cell('45','15','MONTANT','1','1','c');

        
        while($row=mysqli_fetch_assoc($data)){
            $pdf->SetFont('Arial','B','14');
            $pdf->cell('55','15',$row['CARBURANT'],'1','0','c');
            $pdf->cell('35','15',$row['PU'],'1','0','c');
            $pdf->cell('45','15',$row['QUANTITE'],'1','0','c');
            $pdf->cell('45','15',$row['MONTANT'],'1','1','c');
        }
        $pdf->cell(90);
        $pdf->cell('45','15','TOTAL','1','0','c');
        $pdf->cell('45','15',$somme,'1','1','c');
        $pdf->Ln(15);
        $pdf->cell('150','20','ARRETEE LA PRESENTE FACTURE A LA SOMME DE :','0','0','c');
        $pdf->Ln(8);
        $pdf->cell('150','20',$valueMaj,'0','0','c');
        $pdf->Ln(8);
        $pdf->cell('20','20','FMG','0','0','c');
        $pdf->Output();
    }

    //  facture chiffre en lettre

 function convertStr($a)
 {
     if ($a<17){
     switch ($a){
     case 0: return 'zero';
     case 1: return 'un';
     case 2: return 'deux';
     case 3: return 'trois';
     case 4: return 'quatre';
     case 5: return 'cinq';
     case 6: return 'six';
     case 7: return 'sept';
     case 8: return 'huit';
     case 9: return 'neuf';
     case 10: return 'dix';
     case 11: return 'onze';
     case 12: return 'douze';
     case 13: return 'treize';
     case 14: return 'quatorze';
     case 15: return 'quinze';
     case 16: return 'seize';
     }
     } else if ($a<20){
     return 'dix-'.convertStr($a-10);
     } else if ($a<100){
     if ($a%10==0){
     switch ($a){
     case 20: return 'vingt';
     case 30: return 'trente';
     case 40: return 'quarante';
     case 50: return 'cinquante';
     case 60: return 'soixante';
     case 70: return 'soixante-dix';
     case 80: return 'quatre-vingt';
     case 90: return 'quatre-vingt-dix';
     }
     } elseif (substr($a, -1)==1){
     if( ((int)($a/10)*10)<70 ){
     return convertStr((int)($a/10)*10).'-et-un';
     } elseif ($a==71) {
     return 'soixante-et-onze';
     } elseif ($a==81) {
     return 'quatre-vingt-un';
     } elseif ($a==91) {
     return 'quatre-vingt-onze';
     }
     } elseif ($a<70){
     return convertStr($a-$a%10).'-'.convertStr($a%10);
     } elseif ($a<80){
     return convertStr(60).'-'.convertStr($a%20);
     } else{
     return convertStr(80).'-'.convertStr($a%20);
     }
     } else if ($a==100){
     return 'cent';
     } else if ($a<200){
     return convertStr(100).' '.convertStr($a%100);
     } else if ($a<1000){
     return convertStr((int)($a/100)).' '.convertStr(100).' '.convertStr($a%100);
     } else if ($a==1000){
     return 'mille';
     } else if ($a<2000){
     return convertStr(1000).' '.convertStr($a%1000).' ';
     } else if ($a<1000000){
     return convertStr((int)($a/1000)).' '.convertStr(1000).' '.convertStr($a%1000);
     }
     else if ($a==1000000){
     return 'millions';
     }
     else if ($a<2000000){
     return convertStr(1000000).' '.convertStr($a%1000000).' ';
     }
     else if ($a<1000000000){
     return convertStr((int)($a/1000000)).' '.convertStr(1000000).' '.convertStr($a%1000000);
     }
 }


?>



<!-- // function showpdfent(){
//     $pdf= new TCPDF('P',PDF_UNIT, PDF_PAGE_FORMAT, true,'UTF-8',false);
//     $pdf->SetCreator(PDF_CREATOR);
//     $pdf->SetTitle("Liste Client :");
//     $pdf->SetHeaderData('','',PDF_HEADER_TITLE,PDF_HEADER_STRING);
//     $pdf->SetHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
//     $pdf->SetFooterFont(Array(PDF_FONT_NAME_DATA,'',PDF_FONT_SIZE_DATA));
//     $pdf->SetDefaultMonospacedFont('helvetica');
//     $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//     $pdf->SetMargins(PDF_MARGIN_LEFT,'5',PDF_MARGIN_RIGHT);
//     $pdf->SetPrintHeader(false);
//     $pdf->SetPrintFooter(false);
//     $pdf->SetAutoPageBreak(TRUE, 10);
//     $pdf->SetFont('helvetica','',12);

//     $content ='';
//     $content .='    
//         <h3 align="center">Liste Client</h3><br/><br/>
//         <table border="1" cellspacing="0" cellpadding="5">
//                 <tr>
//                     <th width="10%">Code client</th>
//                     <th width="40%">Nom</th>
//                 </tr>
//     ';
//     $content .= fetchclient();
//     $content .='</table>';
//     $pdf->writeHTML($content);
//     $pdf->Output("Liste_client.pdf","I");

// } -->