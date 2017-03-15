<?php
if(isset($_FILES['image1']) && isset($_FILES['image2']))
{ 
    //  $dossier = 'upload/';
     $fichier = basename("nom_print_template.png");
     echo $fichier;
     var_dump($_FILES);
     if(move_uploaded_file($_FILES['image1']['tmp_name'], $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Upload effectué avec succès !';
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
    $fichier2 = basename("nom_image_brute.jpg");
     if(move_uploaded_file($_FILES['image2']['tmp_name'], $fichier2)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Upload effectué avec succès !';
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
     $Résultat = exec ("java imagesMerge", $TabResult, $CodeRetour);
     echo $CodeRetour;
}
?>