<?php
try
{
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	$bdd = new PDO('mysql:host=localhost;dbname=basephp;charset=utf8', 'root', '',$options);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>