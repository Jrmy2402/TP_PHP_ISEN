<?php session_start();
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
    <div class="container">
      <form class="form-signin" action="do_traitement_city.php" method="post">
        <h2 class="form-signin-heading">Adresse</h2>
        <label for="inputVille" class="sr-only">Ville</label>
        <input type="text" id="inputVille" class="form-control" placeholder="Ville" name="Ville" autofocus>
        <label for="inputCP" class="sr-only">CP</label>
        <input type="text" id="inputCP" class="form-control" placeholder="CP" name="CP" autofocus>
        <label for="inputRue" class="sr-only">Rue</label>
        <input type="text" id="inputRue" class="form-control" name="Rue" placeholder="Rue">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Commande</button>
      </form>
    </div>
    <!-- /container -->
  </body>

  </html>