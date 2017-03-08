<?php 
include 'session.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Signin Template for Bootstrap</title>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="styles.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
        crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Bonjour  <?php echo $_SESSION['Nom']?></a>
        </div>
      </div>
    </nav>
    <div class="container margin">
        <form  action="do_traitement.php" method="post">
            <?php
                for($i = 1; $i < 6; ++$i) {
            ?>
            <div class="row margin">
                <div class="col-md-2">
                    <div class="input-group">
                        <span class="input-group-addon">Type</span>
                        <select class="form-control" name="Transaction[Type][<?php echo $i?>]">
                            <option>Virement</option>
                            <option>Prélévement</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <span class="input-group-addon">Montant</span>
                        <input name="Transaction[Montant][<?php echo $i?>]" type="number" step="0.01" class="form-control" >
                        <!--<span class="input-group-addon">.00</span>-->
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <span class="input-group-addon">Devise</span>
                        <select class="form-control" name="Transaction[Devise][<?php echo $i?>]">
                            <option>£</option>
                            <option>$</option>
                            <option>€</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-addon">Compte débiteur</span>
                        <input type="text" name="Transaction[CompteDebiteur][<?php echo $i?>]" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-addon">Compte emetteur</span>
                        <input type="text" name="Transaction[CompteEmetteur][<?php echo $i?>]" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </div>
            </div>
            <?php
                }
            ?>

            <div class="row margin">
                <div class="col-md-4 col-md-offset-8">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
                </div>
            </div>
        </form>
        <div class="row margin">
            <div class="col-md-4 col-md-offset-8">
                <a href="download.php" class="btn btn-lg btn-danger btn-block" role="button">Download file</a>
            </div>
        </div>
    </div>
</body>

</html>