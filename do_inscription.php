<?PHP
session_start();
if(isset($_REQUEST["Nom"])  && isset($_REQUEST["Prenom"]) && isset($_REQUEST["password"]))  {
    include 'connexion.php';
    $Requête = "INSERT INTO `user`(`MotDePasse`, `Nom`, `Prenom`) VALUES (:MotDePasse,:Nom,:Prenom)";
    echo $Requête;
    echo "</br>";
    $passwordcrypted = sha1($_REQUEST["password"]);
    // echo sha1($_REQUEST["password"]);
    $Requete_preparee = $bdd->prepare ($Requête); 
    $Requete_preparee->bindValue(':MotDePasse', $passwordcrypted, PDO::PARAM_STR);
    $Requete_preparee->bindValue(':Nom', $_REQUEST["Nom"], PDO::PARAM_STR);
    $Requete_preparee->bindValue(':Prenom', $_REQUEST["Prenom"], PDO::PARAM_STR);
    // $Requete_preparee->bindValue(':DateConnect', time(), PDO::PARAM_STR);
    var_dump($Requete_preparee);
    echo "</br>";
    $Resultat = $Requete_preparee->execute();
    echo "Resultat is :";
    echo $Resultat;
    header('Location: index.php');

    
}else{
    echo "Problème de user";
}
?>