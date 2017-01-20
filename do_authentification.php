<?PHP
session_start();
if(isset($_REQUEST["user"]) && isset($_REQUEST["password"]))  {
    include 'connexion.php';
    $Requête = "select * from user where Nom=:Nom and MotDePasse=:MotDePasse";
    $Requete_preparee = $bdd->prepare ($Requête); 
    $Requete_preparee->bindValue(':Nom', $_REQUEST["user"], PDO::PARAM_STR);
    $Requete_preparee->bindValue(':MotDePasse', sha1($_REQUEST["password"]), PDO::PARAM_STR);
    $Resultat = $Requete_preparee->execute();
    // echo $Resultat;
    $Valeur = $Requete_preparee->fetchAll(PDO::FETCH_ASSOC);
    
    if ($Valeur[0]){
        var_dump($Valeur);
        echo $Valeur[0]['IdUser'];
        $_SESSION['IdUser'] = $Valeur[0]['IdUser'];
        $_SESSION['Nom'] = $Valeur[0]['Nom'];
        echo "c'est good";
        header('Location: saisie.php?user='.$_REQUEST["user"]);
    } else {
        echo "c'est PAS good";
        header('Location: index.php');
    }
    
}else{
    echo "Problème de user";
}
?>