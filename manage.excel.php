<?php
    require_once("connection.php");

    if (isset($_POST["exportClientExcel"])) {
        clientExcel();
    }
    if (isset($_POST["exportCarburantExcel"])) {
        carburantExcel();
    }
    if (isset($_POST["exportAchatExcel"])) {
        listeAchatExcel();
    }
    if (isset($_POST["exportFactureExcel"])) {
        factureExcel();
    }


    // Client
    function All_listeClient(){
        global $mysqli;
        $sql="SELECT * FROM client;";
        $res=mysqli_query($mysqli, $sql);
        if($res){
            return $res;
        }
        else{
            echo 'error,check the query';
        }
    }
    function clientExcel(){
        $productResult = All_listeClient();
        $filename = "Liste_Client.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $isPrintHeader = false;
        if (! empty($productResult)) {
            echo "Liste client :\n\n";
            foreach ($productResult as $row) {
                if (! $isPrintHeader) {
                    echo implode("\t", array_keys($row)) . "\n";
                    $isPrintHeader = true;
                }
                echo implode("\t", array_values($row)) . "\n";
            }
        }
        exit();
    }

    // carburant
    function listeCarburant(){
        global $mysqli;
        $sql="SELECT * FROM carburant;";
        $res=mysqli_query($mysqli, $sql);
        if($res){
            return $res;
        }
        else{
            echo 'error,check the query';
        }
    }

    function carburantExcel(){
        $productResult = listeCarburant();
        $filename = "Liste_Carburant.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $isPrintHeader = false;
        if (! empty($productResult)) {
            echo "Liste carburant :\n\n";
            echo "\n";
            foreach ($productResult as $row) {
                if (! $isPrintHeader) {
                    echo implode("\t", array_keys($row)) . "\n";
                    $isPrintHeader = true;
                }
                echo implode("\t", array_values($row)) . "\n";
            }
        }
        exit();
    }

    // liste achat
    function listeAchat(){
        global $mysqli;
        $sql = "SELECT design as CARBURANT, nomcli as NOM, dateachat as DATE, pu as PU, qte as QUANTITE, pu*qte as MONTANT
                FROM carburant c, client cli, achat achat 
                WHERE (c.numcarburant = achat.numcarburant) AND (cli.codecli = achat.codecli);";
        $res = mysqli_query($mysqli, $sql);
        if($res){
            return $res; 
        }
        else{
            echo 'error,check the query';
        }
    }

    function listeAchatExcel(){
        $productResult = listeAchat();
        $filename = "Liste_Achat.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $isPrintHeader = false;
        if (! empty($productResult)) {
            echo "Liste achat :\n\n";
            foreach ($productResult as $row) {
                if (! $isPrintHeader) {
                    echo implode("\t\t", array_keys($row)) . "\n";
                    $isPrintHeader = true;
                }
                echo implode("\t\t", array_values($row)) . "\n";
            }
        }
        exit();
    }





    // // Facture sisaaaaaaaaa


    function showName(){
        $getName=NameClientQuerry();
        while($row=mysqli_fetch_assoc($getName)){
            $nomcliFact=$row['Nom'];
        }
        return $nomcliFact;
    }

    function refFact(){
        global $mysqli;
        $client_selected=$_GET['GET_ID_CLI'];
        $trans= str_ireplace('Cli-','Ref-',$client_selected);
        return $trans;
    }

    function codeFa(){
        global $mysqli;
        $code=$_GET['GET_ID_CLI'];
        return $code;
    }

    function datefa(){
        setlocale(LC_TIME, 'fr_FR');
        $daty=date('d-m-Y');
        return $daty;
    }

    function heurefa(){
        setlocale(LC_TIME, 'fr_FR');
        $lera=date('H:i:s');
        return $lera;
    }

    function getFactureClient(){
        global $mysqli;
        $client_selected=$_GET['GET_ID_CLI'];
        $sql = "SELECT c.design as CARBURANT, c.pu as PU, a.qte as QUANTITE, pu*qte as MONTANT 
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

    function NameClientQuerry(){
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
    function AmountFacture(){
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
    function showAmount(){
        $getS=AmountFacture();
        while($row=mysqli_fetch_assoc($getS)){
            $som=$row['somme'];
        }
        return $som;
    }

    function factureExcel(){
        $productResult = getFactureClient();
        $ref=refFact();
        $name=showName();
        $codeclient=codeFa();
        $datefa=datefa();
        $heurefa=heurefa();
        $somme=showAmount();

        $filename = "Facture_Client.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        $isPrintHeader = false;
        if (! empty($productResult)) {
            echo "\t\t\t\tFacture Numero :" .$ref. "\n";
            echo "\tNom :".$name. "\t\t\t Date :" .$datefa. "\n";
            echo "\tNumClient :" .$codeclient. "\t\t\t Heure :" .$heurefa. "\n\n";;
            foreach ($productResult as $row) {
                if (! $isPrintHeader) {
                    echo implode("\t\t", array_keys($row)) . "\n";
                    $isPrintHeader = true;
                }
                echo implode("\t\t", array_values($row)) . "\n";
            }
            echo "\t\t\t\tTOTAL\t\t" .$somme. "";
        }
        exit();
        }

        // // liste Achat
        // function listeAchatExcel2(){
        //     $res='';
        //     global $mysqli;
        //     $liste=listeAchat();
        //     while($row=mysqli_fetch_array($liste)){
        //         $res .= '
        //             <tr>
        //                 <td>'.$row['nomcli'].'</td>
        //                 <td>'.$row['codecli'].'</td>
        //                 <td>'.$row['codecli'].'</td>
        //                 <td>'.$row['codecli'].'</td>
        //             </tr>
        //         ';
        //     }
        //     return $res;
        // }

?>