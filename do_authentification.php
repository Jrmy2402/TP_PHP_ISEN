<?PHP
session_start();
if(isset($_REQUEST["user"]) && isset($_REQUEST["password"]))  {
    // echo "c'est good";
    $ptr = fopen ("userbase.text" , "r+");
    $lenghFichier = 0;
    if($ptr){
        while(!feof($ptr)){
            $Tableau = fgetcsv($ptr,4096, ";");
            // echo "</br>";
            print_r ($Tableau);   
            reset ($Tableau);
            if($Tableau[0]==$_REQUEST["user"]){
                // echo "</br> user est bon";
                if($Tableau[1]==$_REQUEST["password"]){
                    // echo "</br> password aussi";
                    $lenghTableau = strlen($Tableau[0]) + strlen($Tableau[1]) +2;
                    fseek($ptr, ($lenghTableau+$lenghFichier)); // On remet le curseur au début du fichier
                    // echo "</br> nombre :". $lenghTableau . " - " . $lenghFichier;
                    $date = date("d-m-y");
                    $lenghTableau = $lenghTableau + strlen($date) + 2;
                    $lenghFichier = $lenghFichier + $lenghTableau;
                    $_SESSION["Nom"] = $Tableau[0];
                    fputs($ptr, $date); // On écrit le nouveau nombre de pages vues
                    // fseek($ptr, $lenghFichier); // On remet le curseur au début du fichier
                    header('Location: saisie.php?user='.$Tableau[0]);
                }else{
                    echo "</br> password faux";
                }
                break;
            
            }else{
                $lenghFichier = $lenghFichier + strlen($Tableau[0]) + strlen($Tableau[1]) + strlen($Tableau[2]) +4;
            }
    }
}else{
    echo "</br> Fichier vide";
}
}else{
    echo "Problème de user";
}
?>