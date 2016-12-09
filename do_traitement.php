<?PHP
session_start();
$Tansaction = $_REQUEST["Tansaction"];
// var_dump($Tansaction);
for($i = 1; $i < 6; ++$i) {
    if($Tansaction["Montant"][$i] != "" && $Tansaction["Devise"][$i]!= "" && $Tansaction["CompteEmetteur"][$i]!= "" && $Tansaction["CompteDebiteur"][$i]!= "")  {
        if($Tansaction["Type"][$i]=="Prélévement"){
            $ptr = fopen ("prelevement.text" , "a");
            if($ptr){
                $string = time()+$i . ";" . $Tansaction["Montant"][$i] . ";" . $Tansaction["Devise"][$i] . ";" . $Tansaction["CompteDebiteur"][$i] . ";" . $Tansaction["CompteEmetteur"][$i] . ";" . $_SESSION["Nom"] ."\n";
                fputs($ptr, $string);
                fclose($ptr);
            }
        }else{
            $ptr = fopen ("virement.text" , "a");
            if($ptr){
                $string = time()+$i . ";" . $Tansaction["Montant"][$i] . ";" . $Tansaction["Devise"][$i] . ";" . $Tansaction["CompteDebiteur"][$i] . ";" . $Tansaction["CompteEmetteur"][$i] . ";" . $_SESSION["Nom"] ."\n";
                fputs($ptr, $string);
                fclose($ptr);
            }
        }
    }else{
        echo "Pas de traitement";
    }
}

?>