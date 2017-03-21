<?php 
session_start();
if(isset($_REQUEST["Ville"])  && isset($_REQUEST["CP"]) && isset($_REQUEST["Rue"]))  {
        // create curl resource 
        $ch = curl_init(); 
        $myParams = 'address='. $_REQUEST["Ville"] .'&zipCode='.$_REQUEST["CP"].'&city='. $_REQUEST["Rue"].'&request_id=43&date_from=04/01/2011';
        // set url 
        curl_setopt($ch, CURLOPT_URL, "http://exapaq.pickup-services.com/Exapaq/mypudofull.asmx/GetPudoList"); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        curl_setopt($ch, CURLOPT_POSTFIELDS,  $myParams);

        // $output contains the output string 
        $output = curl_exec($ch); 

        $xml = simplexml_load_string($output);
        $json = json_encode($xml);

        // close curl resource to free up system resources 
        curl_close($ch);
        $_SESSION['list'] = $json;
        header('Location: resultat_commande.php');

}else{
  echo "Problème adresse";
}
?>