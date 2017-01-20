<?PHP
session_start();
$Transaction = $_REQUEST["Transaction"];
// var_dump($Transaction);
$nbVir = 0;
$nbPre = 0;
$MontantPre = 0;
$MontantVir = 0;
$NulLot = time();

function TauxEchange($Montant, $MontantTotal, $Devise)
{
    if($Devise == "$"){
        $MontantTotal = $MontantTotal + ($Montant*1.05733);
    }else if ($Devise == "£"){
        $MontantTotal = $MontantTotal + ($Montant*0.840728);
    } else {
        $MontantTotal = $MontantTotal + $Montant;
    }
    return $MontantTotal;
}
function NameDevise($Devise)
{
    if($Devise == "$"){
        $DeviseName = 'USD';
    }else if ($Devise == "£"){
        $DeviseName = 'GBP';
    } else {
        $DeviseName = 'EUR';
    }
    return $DeviseName;
}
include 'connexion.php';

for($i = 1; $i < 6; ++$i) {
    if($Transaction["Montant"][$i] != "" && $Transaction["Devise"][$i]!= "" && $Transaction["CompteEmetteur"][$i]!= "" && $Transaction["CompteDebiteur"][$i]!= "")  {
        if($Transaction["Type"][$i]=="Prélévement"){

            echo "Prélévement";
            echo "</br>";
            $Requête = "INSERT INTO `operations`(`montant`, `IdUser`, `Devise`, `Type`, `CptOrigine`, `CptDest`, `NumLot`) VALUES (:Montant,:IdUser,:Devise,:Type,:CptOrigine,:CptDest,:NumLot)";
            echo $Requête;
            echo "</br>";
            $Requete_preparee = $bdd->prepare ($Requête); 
            $Requete_preparee->bindValue(':Montant', $Transaction["Montant"][$i], PDO::PARAM_STR);
            $Requete_preparee->bindValue(':IdUser', $_SESSION['IdUser'], PDO::PARAM_STR);
            $Requete_preparee->bindValue(':Type', 'PRE', PDO::PARAM_STR);
            $Requete_preparee->bindValue(':Devise', NameDevise($Transaction["Devise"][$i]), PDO::PARAM_STR);
            $Requete_preparee->bindValue(':CptOrigine', $Transaction["CompteDebiteur"][$i], PDO::PARAM_STR);
            $Requete_preparee->bindValue(':CptDest', $Transaction["CompteEmetteur"][$i], PDO::PARAM_STR);
            $Requete_preparee->bindValue(':NumLot', $NulLot, PDO::PARAM_STR);
            print_r($Requete_preparee);
            echo "</br>";
            $Resultat = $Requete_preparee->execute();
            echo $Resultat;
            echo "</br>";
            $nbPre++;
            $MontantPre = TauxEchange($Transaction["Montant"][$i], $MontantPre, $Transaction["Devise"][$i]);

        }else{

            echo "Prélévement";
            echo "</br>";
            $Requête = "INSERT INTO `operations`(`montant`, `IdUser`, `Devise`, `Type`, `CptOrigine`, `CptDest`, `NumLot`) VALUES (:Montant,:IdUser,:Devise,:Type,:CptOrigine,:CptDest,:NumLot)";
            echo $Requête;
            echo "</br>";
            $Requete_preparee = $bdd->prepare ($Requête); 
            $Requete_preparee->bindValue(':Montant', $Transaction["Montant"][$i], PDO::PARAM_STR);
            $Requete_preparee->bindValue(':IdUser', $_SESSION['IdUser'], PDO::PARAM_STR);
            $Requete_preparee->bindValue(':Type', 'VIR', PDO::PARAM_STR);
            $Requete_preparee->bindValue(':Devise', NameDevise($Transaction["Devise"][$i]), PDO::PARAM_STR);
            $Requete_preparee->bindValue(':CptOrigine', $Transaction["CompteDebiteur"][$i], PDO::PARAM_STR);
            $Requete_preparee->bindValue(':CptDest', $Transaction["CompteEmetteur"][$i], PDO::PARAM_STR);
            $Requete_preparee->bindValue(':NumLot', $NulLot, PDO::PARAM_STR);
            print_r($Requete_preparee);
            echo "</br>";
            $Resultat = $Requete_preparee->execute();
            echo $Resultat;
            echo "</br>";
            $nbVir++;
            $MontantVir = TauxEchange($Transaction["Montant"][$i], $MontantVir, $Transaction["Devise"][$i]);
        }
    }else{
        echo "Pas de traitement";
        echo "</br>";
    }
}
header('Location: resultat.php?nbPre='.$nbPre.'&nbVir='.$nbVir.'&MontantPre='.$MontantPre.'&MontantVir='.$MontantVir);

?>