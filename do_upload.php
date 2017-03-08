<?php
session_start();
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
if(isset($_FILES['userfile']))
{   
    $nbVir = 0;
    $nbPre = 0;
    $MontantPre = 0;
    $MontantVir = 0;
    $NulLot = time();
    include 'connexion.php';
    var_dump($_FILES);
    echo 'Il y a un fichier ' . $_FILES['userfile']['tmp_name'];
    $row = 1;
    if (($handle = fopen($_FILES['userfile']['tmp_name'], "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
        if($data[0]=="PRE"){
            echo "Prélévement";
            echo "</br>";
            $Requête = "INSERT INTO `operations`(`montant`, `IdUser`, `Devise`, `Type`, `CptOrigine`, `CptDest`, `NumLot`) VALUES (:Montant,:IdUser,:Devise,:Type,:CptOrigine,:CptDest,:NumLot)";
            echo $Requête;
            echo "</br>";
            $Requete_preparee = $bdd->prepare ($Requête); 
            $Requete_preparee->bindValue(':Montant', $data[1], PDO::PARAM_STR);
            $Requete_preparee->bindValue(':IdUser', $_SESSION['IdUser'], PDO::PARAM_STR);
            $Requete_preparee->bindValue(':Type', 'PRE', PDO::PARAM_STR);
            $Requete_preparee->bindValue(':Devise', NameDevise($data[2]), PDO::PARAM_STR);
            $Requete_preparee->bindValue(':CptOrigine', $data[3], PDO::PARAM_STR);
            $Requete_preparee->bindValue(':CptDest', $data[4], PDO::PARAM_STR);
            $Requete_preparee->bindValue(':NumLot', $NulLot, PDO::PARAM_STR);
            print_r($Requete_preparee);
            echo "</br>";
            $Resultat = $Requete_preparee->execute();
            echo $Resultat;
            echo "</br>";
            $nbPre++;
            $MontantPre = TauxEchange($data[1], $MontantPre, $data[2]);
        } else {
            echo "Virement";
            echo "</br>";
            $Requête = "INSERT INTO `operations`(`montant`, `IdUser`, `Devise`, `Type`, `CptOrigine`, `CptDest`, `NumLot`) VALUES (:Montant,:IdUser,:Devise,:Type,:CptOrigine,:CptDest,:NumLot)";
            echo $Requête;
            echo "</br>";
            $Requete_preparee = $bdd->prepare ($Requête); 
            $Requete_preparee->bindValue(':Montant', $data[1], PDO::PARAM_STR);
            $Requete_preparee->bindValue(':IdUser', $_SESSION['IdUser'], PDO::PARAM_STR);
            $Requete_preparee->bindValue(':Type', 'VIR', PDO::PARAM_STR);
            $Requete_preparee->bindValue(':Devise', NameDevise($data[2]), PDO::PARAM_STR);
            $Requete_preparee->bindValue(':CptOrigine', $data[3], PDO::PARAM_STR);
            $Requete_preparee->bindValue(':CptDest', $data[4], PDO::PARAM_STR);
            $Requete_preparee->bindValue(':NumLot', $NulLot, PDO::PARAM_STR);
            print_r($Requete_preparee);
            echo "</br>";
            $Resultat = $Requete_preparee->execute();
            echo $Resultat;
            echo "</br>";
            $nbVir++;
            $MontantVir = TauxEchange($data[1], $MontantVir, $data[2]);
        }
      }
      fclose($handle);
    }
    header('Location: resultat.php?nbPre='.$nbPre.'&nbVir='.$nbVir.'&MontantPre='.$MontantPre.'&MontantVir='.$MontantVir);
} else {
  echo 'Il n\'y a pas de fichier';
}
?>